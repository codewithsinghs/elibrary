<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomPageController extends Controller
{
    public function about(){
        return view('custom.about');
    }
}
