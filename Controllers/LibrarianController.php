<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LibrarianController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('librarian.dashboard', compact('users'));
    }
    // public function index()
    // {
    //     $user = Auth::user();
    //     // Fetch data for the admin dashboard
    //     $users = User::all();
    //     $userActivity = UserActivity::all();
    //     $roles = Role::all();
    //     $profiles = Profile::all();

    //     return view('admin.dashboard', compact('user', 'users', 'userActivity', 'roles', 'profiles'));
    // }
}
