<?php

namespace App\Http\Controllers\Data;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('permission:create-role|edit-role|delete-role', ['only' => ['index','show']]);
    //     $this->middleware('permission:create-role', ['only' => ['create','store']]);
    //     $this->middleware('permission:edit-role', ['only' => ['edit','update']]);
    //     $this->middleware('permission:delete-role', ['only' => ['destroy']]);
    // }

    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('manage.roles.index', compact('roles', 'permissions'));
        // $roles = Role::all();
        // $usersWithRoles = User::with('roles')->get();
        // return view('manage.roles.index', compact('usersWithRoles', 'roles'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('manage.roles.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $role = Role::create(['name' => $request->name]);

    //     $permissions = Permission::whereIn('id', $request->permissions)->get(['name'])->toArray();

    //     $role->syncPermissions($permissions);

    //     return redirect()->route('roles.index')
    //             ->withSuccess('New role is added successfully.');
    // }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')],
            'permissions.*' => ['nullable', 'exists:permissions,id'], // Ensure permissions exist in the permissions table
            'new_permission' => ['nullable', 'string', 'max:255', 'unique:permissions,name'], // Ensure new permissions are unique
        ]);

        // Create the role
        $role = Role::create(['name' => $request->name]);

        // Get the selected permission IDs from the request
        $permissionIds = $request->permissions ?? [];

        // Handle new permission
        if ($request->filled('new_permission')) {
            // Check if the new permission already exists
            $existingPermission = Permission::where('name', $request->new_permission)->first();
            if (!$existingPermission) {
                // Create the new permission if it doesn't exist
                $newPermission = Permission::create(['name' => $request->new_permission]);
                // Add the ID of the new permission to the list of permission IDs
                $permissionIds[] = $newPermission->id;
            }
        }

        // Filter out any invalid or non-existing permission IDs
        $validPermissionIds = Permission::whereIn('id', $permissionIds)->pluck('id')->toArray();

        // Sync valid permission IDs to the role
        $role->syncPermissions($validPermissionIds);

        return redirect()->route('roles.index')
            ->withSuccess('New role is added successfully.');
    }


    /**
     * Display the specified resource.
     * 
     */

    public function show(Role $role)
    {
        $rolePermissions = Permission::join("role_has_permissions", "permission_id", "=", "id")
            ->where("role_id", $role->id)
            ->select('name')
            ->get();
        return view('manage.roles.show', [
            'role' => $role,
            'rolePermissions' => $rolePermissions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id, Role $role)
    public function edit(Role $role)
    {
        if ($role->name == 'Super Admin') {
            abort(403, 'SUPER ADMIN ROLE CAN NOT BE EDITED');
        }

        $rolePermissions = DB::table("role_has_permissions")->where("role_id", $role->id)
            ->pluck('permission_id')
            ->all();

        return view('manage.roles.edit', [
            'role' => $role,
            'permissions' => Permission::get(),
            'rolePermissions' => $rolePermissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $input = $request->only('name');

        $role->update($input);

        $permissions = Permission::whereIn('id', $request->permissions)->get(['name'])->toArray();

        $role->syncPermissions($permissions);

        return redirect()->back()
            ->withSuccess('Role is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if ($role->name == 'Super Admin') {
            abort(403, 'SUPER ADMIN ROLE CAN NOT BE DELETED');
        }
        if (auth()->user()->hasRole($role->name)) {
            abort(403, 'CAN NOT DELETE SELF ASSIGNED ROLE');
        }
        $role->delete();
        return redirect()->route('roles.index')
            ->withSuccess('Role is deleted successfully.');
    }

    public function changeRole(Request $request, $userId)
    {
        // Retrieve the user by ID
        $user = User::findOrFail($userId);

        // Validate the request data
        $request->validate([
            'role_id' => 'required|exists:roles,id', // Ensure the selected role exists in the roles table
        ]);

        // Retrieve the selected role
        $role = Role::findOrFail($request->role_id);

        // Sync the user's roles with the selected role
        $user->syncRoles([$role->name]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'User role changed successfully.');
    }
}
