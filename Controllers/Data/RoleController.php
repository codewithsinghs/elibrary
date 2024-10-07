<?php

namespace App\Http\Controllers\Data;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        // $roles = Role::all();
        return view('manage.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
            'new_permissions' => 'nullable|string',
        ]);

        // Create the role
        $role = Role::create(['name' => $request->input('name')]);

        // Retrieve existing permissions selected in the form
        $permissionNames = $request->input('permissions');

        // Retrieve and create new permissions
        $newPermissions = explode(',', $request->input('new_permissions'));
        foreach ($newPermissions as $permissionName) {
            $permissionName = trim($permissionName);
            if (!empty($permissionName)) {
                // Find or create the permission by name
                $permission = Permission::firstOrCreate(['name' => $permissionName]);
                $permissionNames[] = $permission->name;
            }
        }

        // Sync permissions to the role
        $role->syncPermissions($permissionNames);

        return redirect()->route('roles.index')
            ->with('success', 'Role & permissions created successfully');
    }

    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('manage.roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('manage.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // Validate request data
        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required|array',
            'new_permissions' => 'nullable|string',
        ]);

        // Update the role name
        $role->update(['name' => $request->input('name')]);

        // Retrieve existing permissions selected in the form
        // $permissionNames = $request->input('permissions');
        $permissionNames = Permission::whereIn('id', $request->input('permissions'))->get();

        // Retrieve and create new permissions
        $newPermissions = explode(',', $request->input('new_permissions'));
        foreach ($newPermissions as $permissionName) {
            $permissionName = trim($permissionName);
            if (!empty($permissionName)) {
                // Find or create the permission by name
                $permission = Permission::firstOrCreate(['name' => $permissionName]);
                $permissionNames[] = $permission->name;
            }
        }

        // Sync permissions to the role
        $role->syncPermissions($permissionNames);

        // Redirect with success message
        return redirect()->route('roles.index')
            ->with('success', 'Role & permissions updated successfully');
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
    /**
     * Remove the specified resource from storage.
     */

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
