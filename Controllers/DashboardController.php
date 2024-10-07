<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function home()
    {
        $user = Auth::user();

        return view('home', compact('user'));
        //return view($dashboardView);
    }

    // public function index()
    // {
    //     $user = Auth::user();
    //     $dashboardView = match ($user->getRoleNames()->first()) {
    //         'admin' => 'admin.dashboard',
    //         'manager' => 'manager.dashboard',
    //         'librarian' => 'librarian.dashboard',
    //         'teacher' => 'teacher.dashboard',
    //         'student' => 'student.dashboard',
    //         'member' => 'member.dashboard',
    //         default => 'dashboard',
    //     };

    //     return redirect()->route($dashboardView);
    //     //return view($dashboardView);
    // }

    // public function index()
    // {
    //     $user = Auth::user();
    //     $role = $user->getRoleNames()->first();

    //     // Define dashboard routes based on role naming convention
    //     $dashboardRoutes = [
    //         'admin' => 'admin.dashboard',
    //         'manager' => 'manager.dashboard',
    //         'librarian' => 'librarian.dashboard',
    //         'teacher' => 'teacher.dashboard',
    //         'student' => 'student.dashboard',
    //         'member' => 'member.dashboard',
    //     ];

    //     // Default dashboard route if user role is not found in the defined cases
    //     $defaultDashboard = 'dashboard';

    //     // Check if user's role matches any defined cases, otherwise use default
    //     $dashboardView = $dashboardRoutes[$role] ?? $defaultDashboard;

    //     return redirect()->route($dashboardView);
    // }

    public function index()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Redirect to login if the user is not authenticated
            return redirect('/login')->with('error', 'You are not logged in.');
        }
    
        $user = Auth::user();
        
        // Check if the user has any roles
        if ($user->roles->isEmpty()) {
            // Redirect to a default dashboard or show an error message if the user has no roles
            return view('dashboard')->with('info', 'Your account has no assigned role.');
        }
    
        // Get the user's first role
        $role = $user->getRoleNames()->first();
    
        // Define dashboard routes based on role naming convention
        $dashboardRoutes = [
            'admin' => 'admin.dashboard',
            'manager' => 'manager.dashboard',
            'librarian' => 'librarian.dashboard',
            'teacher' => 'teacher.dashboard',
            'student' => 'student.dashboard',
            'member' => 'member.dashboard',
        ];
    
        // Check if user's role matches any defined cases, otherwise use default
        if (array_key_exists($role, $dashboardRoutes)) {
            // Redirect to the appropriate dashboard route
            return redirect()->route($dashboardRoutes[$role]);
        } else {
            // Return a view indicating that the role is not predefined
            return view('dashboard')->with('info', 'Your role is not predefined.');
        }
    }

    // public function index()
    // {
    //     $user = auth()->user();
    //     $roles = $user->roles->pluck('name')->toArray();

    //     if (in_array('admin', $roles)) {
    //         return redirect()->route('admin.dashboard');
    //     } elseif (in_array('manager', $roles)) {
    //         return redirect()->route('manager.dashboard');
    //     } elseif (in_array('librarian', $roles)) {
    //         return redirect()->route('librarian.dashboard');
    //     } elseif (in_array('teacher', $roles)) {
    //         return redirect()->route('teacher.dashboard');
    //     } elseif (in_array('student', $roles)) {
    //         return redirect()->route('student.dashboard');
    //     } elseif (in_array('member', $roles)) {
    //         return redirect()->route('member.dashboard');
    //     } else {
    //         // Handle non-predefined roles or no roles assigned
    //         return view('dashboard.non_predefined')->with('info', 'Your role is not predefined.');
    //     }
    // }
}
