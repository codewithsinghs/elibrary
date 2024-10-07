<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Models\Profile;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        // Fetch data for the admin dashboard
        $users = User::all();
        $userActivity = UserActivity::all();
        $roles = Role::all();
        $profiles = Profile::all();

        return view('admin.dashboard', compact('user', 'users', 'userActivity', 'roles', 'profiles'));
    }

    public function viewAllUsers()
    {
        // $users = User::all();
        // return view('admin.users.index', compact('users'));

        // Fetch all users along with their member profiles
        //$usersWithProfiles = User::with('profile')->get();
        $users = User::with('profile')->get(); // Eager loading to avoid N+1 queries
        // dd($users);
        // Pass the data to the view
        return view('admin.users.index', compact('users'));
    }
}
