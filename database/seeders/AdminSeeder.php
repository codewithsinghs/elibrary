<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create roles if they don't exist
        // $roles = ['admin', 'librarian', 'member']; // Add other roles as needed
        // foreach ($roles as $roleName) {
        //     Role::firstOrCreate(['name' => $roleName]);
        // }
        
        // Create admin user
        $adminData = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),

            'type' => 'local',
            'status' => 'active',
        ];
        $adminUser = User::create($adminData);

        // Assign roles to the admin user using Spatie Permission
        // $adminUser->assignRole('admin');

        // Create member profile for admin user
        $fullName =  $adminUser->name;
        $nameParts = explode(' ', $fullName); // Split by space

        // Determine last name
        $lastName = array_pop($nameParts);

        // Determine first name
        $firstName = implode(' ', $nameParts); // Join the remaining parts for the first name

        $profileData = [
            'user_id' => $adminUser->id,
           // 'name' => $adminUser->name, // Sync name with User table
           'fname' => $firstName,
           'lname' => $lastName,
            'email' => $adminUser->email,
            // 'type' => "local",
            // 'status' => "active",
            // Add other profile data as needed
        ];
        Profile::create($profileData);
    }
}
