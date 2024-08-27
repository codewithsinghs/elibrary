<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    //
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $managerRole = Role::create(['name' => 'manager']);
        $librarianRole = Role::create(['name' => 'librarian']);
        $teacherRole = Role::create(['name' => 'teacher']);
        $studentRole = Role::create(['name' => 'student']);
        $memberRole = Role::create(['name' => 'member']);

        // Create permissions
        // Common permissions
        $manageUsersPermission = Permission::create(['name' => 'manage_users']);
        $manageContentsPermission = Permission::create(['name' => 'manage_contents']);
        $borrowBooksPermission = Permission::create(['name' => 'borrow_books']);

        // Additional permissions for e-content
        $manageEContentPermission = Permission::create(['name' => 'manage_e_content']);

        // Permissions for librarian
        $activateMemberSubscriptionPermission = Permission::create(['name' => 'activate_member_subscription']);
        $deactivateMemberSubscriptionPermission = Permission::create(['name' => 'deactivate_member_subscription']);

        // Assign permissions to roles
        $adminRole->givePermissionTo([
            $manageUsersPermission,
            $manageContentsPermission,
            $borrowBooksPermission,
            $manageEContentPermission,
            $activateMemberSubscriptionPermission,
            $deactivateMemberSubscriptionPermission
        ]);

        $managerRole->givePermissionTo([
            $manageUsersPermission,
            $manageContentsPermission,
            $borrowBooksPermission,
            $manageEContentPermission,
            $activateMemberSubscriptionPermission,
            $deactivateMemberSubscriptionPermission
        ]);

        $librarianRole->givePermissionTo([
            $manageUsersPermission,
            $manageContentsPermission,
            $manageEContentPermission,
            $activateMemberSubscriptionPermission,
            $deactivateMemberSubscriptionPermission
        ]);

        $teacherRole->givePermissionTo([$manageUsersPermission, $borrowBooksPermission]);
        $studentRole->givePermissionTo([$borrowBooksPermission]);
        $memberRole->givePermissionTo([$borrowBooksPermission]);

        // Assign roles to the default user
        $user = \App\Models\User::find(1); // Adjust user ID as needed
        $user->assignRole('admin');

        // $user2 = \App\Models\User::find(2); // Adjust user ID as needed
        // $user2->assignRole('librarian');

        // $user4 = \App\Models\User::find(4); // Adjust user ID as needed
        // $user4->assignRole('student');

        // $user5 = \App\Models\User::find(5); // Adjust user ID as needed
        // $user5->assignRole('member');
    }
}
