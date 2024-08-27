<?php

namespace App\Http\Controllers\Data;

use App\Models\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;


class UserRolesController extends Controller
{
    //
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('manage.users.edit-roles', compact('user', 'roles'));
    }

    // Update the roles assigned to the user
    public function update(Request $request, User $user)
    {
        try {
            // Validate the request data
            $request->validate([
                'roles' => 'required|array',
                'roles.*' => 'exists:roles,name',
            ]);

            // Synchronize user roles
            $user->syncRoles($request->roles);

            // Redirect with success message
            return redirect()->route('users.index')->with('success', 'User roles updated successfully.');
        } catch (\Throwable $th) {
            // Log the error for debugging purposes
            //  \Log::error('Error updating user roles: ' . $th->getMessage());

            // Redirect back with error message
            return back()->withInput()->with('error', 'An error occurred while updating user roles. Please try again.');
        }
    }
}
