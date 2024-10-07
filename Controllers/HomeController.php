<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Course;
use App\Models\Resource;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeController extends Controller
{
    public function resources(Request $request)
    {

        // Section 1: List all categories
        $categories = Resource::distinct()->pluck('category')->toArray();

        // Section 2: List all resources with pagination
        $resources = Resource::paginate(9);

        // Check if a category is selected
        if ($request->has('category')) {
            $selectedCategory = $request->category;
            // Filter resources by selected category
            $resources = Resource::where('category', $selectedCategory)->paginate(9);
        } else {
            $selectedCategory = null;
        }

        return view('common.resources.index', compact('categories', 'resources', 'selectedCategory'));
    }

    public function viewResource($resource)
    {
        try {
            $resource = Resource::where('slug', $resource)->firstOrFail();
            // If the course is found, return the view with course details
            return view('common.resources.show', compact('resource'));
        } catch (ModelNotFoundException $e) {
            // Handle the case where the course is not found
            return redirect()->back()->with('error', 'Course not found.');
        } catch (Exception $e) {
            // Handle other unexpected exceptions
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    public function courses(Request $request)
    {
        // Section 1: List all categories
        $categories = Course::distinct()->pluck('category')->toArray();

        // Section 2: List all resources
        $courses = Course::query();

        // Check if a category is selected
        if ($request->has('category')) {
            $selectedCategory = $request->category;
            // Filter resources by selected category
            $courses->where('category', $selectedCategory);
        } else {
            $selectedCategory = null;
        }

        // Load all resources
        $courses = $courses->get();
        // dd($courses);

        return view('common.courses.index', compact('categories', 'courses', 'selectedCategory'));
    }

    public function viewCourse($course)
    {
        try {
            // dd($course);
            // Fetch the course based on the course
            $course = Course::where('slug', $course)->firstOrFail();
            // dd($course);
            return view('common.courses.show', compact('course'));
        } catch (ModelNotFoundException $e) {
            // Handle the case where the course is not found
            return redirect()->back()->with('error', 'Course not found.');
        } catch (Exception $e) {
            // Handle other unexpected exceptions
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    public function viewCourseByName($courseName)
    {
        try {
            // // Convert slug back to original course name
            // $courseName = str_replace('-', ' ', $courseName);

            // // Capitalize the first letter of each word
            // $courseName = ucwords($courseName);
            // // dd($courseName);

            // // Retrieve the course by slug
            // $course = Course::whereRaw('LOWER(REPLACE(name, " ", "-")) = ?', [strtolower($courseName)])->firstOrFail();
            // dd($course);
            // Retrieve the course by slug
            $course = Course::where('name', Str::replace('-', ' ', $courseName))->firstOrFail();

            // Return the view with course details
            return view('common.courses.view', compact('course'));
        } catch (ModelNotFoundException $e) {
            // Handle the case where the course is not found
            return redirect()->back()->with('error', 'Course not found.');
        } catch (Exception $e) {
            // Handle other unexpected exceptions
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }
}
