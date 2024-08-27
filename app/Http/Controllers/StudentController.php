<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
         return view('student.dashboard', compact('user'));
        // echo "Redirecting to controller's action.";
    }

    public function profile()
    {
         return view('student.profile');
        // echo "Redirecting to controller's action.";
    }

    public function project()
    {
         return view('student.project');
        // echo "Redirecting to controller's action.";
    }

    public function cource()
    {
         return view('student.cources');
        // echo "Redirecting to controller's action.";
    }

    public function resources()
    {
         return view('student.resources');
        // echo "Redirecting to controller's action.";
    }
}
