<?php

namespace App\Http\Controllers\Data;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255', Rule::unique('roles')],
    //     ]);

    //     Role::create($request->all());

    //     return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    //     // Role::create(['name' => $request->name]);
    //     // return redirect()->route('roles.index')->with('success', 'Role created successfully');
    // }

    public function store(Request $request)
    {
        $request->validate([
            // 'name' => ['required', 'string', 'max:255', Rule::unique('roles')],
            // 'permissions' => ['nullable', 'array'],
            // 'permissions.*' => ['nullable', 'exists:permissions,id'],
            // 'new_permission' => ['nullable', 'string', 'max:255', Rule::unique('permissions')],
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')],
            'permissions.*' => ['nullable', 'string', 'max:255'],
            'new_permission' => ['nullable', 'string', 'max:255'],
        ]);

        // dd($request->all());
        // Create the role
        $role = Role::create(['name' => $request->name]);

        // Sync permissions
        $permissions = collect([]);

        // Handle existing permissions
        if ($request->filled('permissions')) {
            $existingPermissions = collect($request->permissions)->map(function ($permission) {
                // Check if the permission already exists
                $existingPermission = Permission::firstOrCreate(['name' => $permission]);
                return $existingPermission;
            });
            $permissions = $permissions->merge($existingPermissions);
        }

        // Handle new permissions
        if ($request->filled('new_permission')) {
            $newPermissions = collect($request->new_permission)->map(function ($permission) {
                // Check if the permission already exists
                $existingPermission = Permission::firstOrCreate(['name' => $permission]);
                return $existingPermission;
            });
            $permissions = $permissions->merge($newPermissions);
        }

        // Sync permissions to the role
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }


    /**
     * Display the specified resource.
     * 
     */

    public function show($role)
    {

        $role = Role::find($role);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $role)
            ->get();

        return view('manage.roles.show', compact('role', 'rolePermissions'));
    }

    // public function show(string $id)
    // {
    //     $role = Role::findOrFail($id);
    //     return view('manage.roles.show', compact('role'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id, Role $role)
    public function edit(Role $role)
    {
        //  
        $permissions = Permission::all();
        return view('manage.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Role $role)
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
    //     ]);

    //    // $role->update(['name' => $request->name]);
    //    $role->update($request->all());
    //     return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($id)],
            'permissions.*' => ['nullable', 'string', 'max:255'],
            'new_permission' => ['nullable', 'string', 'max:255'],
        ]);
    
        // Find the role to update
        $role = Role::findOrFail($id);
    
        // Update role name
        $role->name = $request->name;
    
        // Save the role
        $role->save();
    
        // Get the existing permissions of the role
        $existingPermissions = $role->permissions->pluck('name')->toArray();
    
        // Merge existing permissions with the new permissions
        $permissions = collect($existingPermissions);
    
        // Handle new permissions
        if ($request->filled('permissions')) {
            $permissions = $permissions->merge($request->permissions);
        }
    
        // Handle new permission
        if ($request->filled('new_permission')) {
            $permissions->push($request->new_permission);
        }
    
        // Sync permissions to the role
        $permissionModels = [];
        foreach ($permissions->unique() as $permissionName) {
            // Find or create the permission by name
            $permission = Permission::where('name', $permissionName)->first();
            if (!$permission) {
                $permission = Permission::create(['name' => $permissionName]);
            }
            $permissionModels[] = $permission;
        }
        $role->syncPermissions($permissionModels);
    
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }
    
    // public function update(Request $request, Role $role)
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
    //         'permissions' => 'array', // Permissions should be an array
    //     ]);

    //     // Update the role's name
    //     $role->update([
    //         'name' => $request->name,
    //     ]);

    //     // Sync the role's permissions with the selected permissions
    //     $role->syncPermissions($request->permissions);

    //     return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
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
