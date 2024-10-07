<?php

namespace App\Http\Controllers\Data;


use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
// use Intervention\Image\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('manage.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('manage.courses.create');
    }

    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $this->validateCourse($request);

            // Use database transactions to ensure data consistency
            DB::beginTransaction();

            // Create the course
            $course = new Course();
            $course->name = $request->name;
            $course->description = $request->description;
            $course->duration = $request->duration;
            $course->category = $request->category;
            $course->level = $request->level;
            $course->instructor = $request->instructor;
            $course->price = $request->price;
            $course->start_date = $request->start_date;
            $course->end_date = $request->end_date;

            // Store the image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Str::slug($request->name) . '_' . now()->format('YmdHis') . '.' . $image->getClientOriginalExtension();

                // Store original image
                $imagePath = $image->storeAs('courses', $imageName, 'public');

                // Generate and store thumbnail
                $thumbnailPath = $this->generateAndStoreThumbnail($image, $imageName);

                // Extract filename from the full path
                $imageNameOnly = pathinfo($imagePath, PATHINFO_BASENAME);

                // Save only the image name to the course model
                $course->image = $imageNameOnly;
            }

            $course->save();

            // Commit the transaction
            DB::commit();

            // Redirect with success message
            return redirect()->route('courses.index')->with('success', 'Course created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation error
            return redirect()->back()->withInput()->withErrors($e->validator->errors()->all());
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            // Log the error
            Log::error('Error creating course: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred while creating course. Please try again.']);
        }
    }

    private function generateAndStoreThumbnail($image, $imageName)
    {
        try {
            // Generate thumbnail
            // $thumbnail = Image::make($image)
            //     ->fit(100) // Adjust size as needed
            //     ->encode(); // Encodes the image to string data

            // $thumbnail = Image::make($image)
            // ->resize(100, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // }) // Resize width to 100px, maintain aspect ratio
            // ->encode(); // Encodes the image to string data

            $thumbnail = Image::make($image)
                ->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                }) // Resize to fit within 100x100 frame, maintain aspect ratio
                ->encode(); // Encodes the image to string data

            // Get the thumbnail name
            // $thumbnailName = 'thumbnail_' . $imageName;
            $thumbnailName = $imageName;

            // Store the thumbnail image to storage
            $thumbnailPath = 'public/courses/thumbnails/' . $thumbnailName;
            Storage::put($thumbnailPath, $thumbnail);

            // Return the path to the stored thumbnail
            return $thumbnailPath;
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error storing thumbnail: ' . $e->getMessage());

            // Throw the exception to propagate it
            throw $e;
        }
    }


    // public function store(Request $request)
    // {
    //     // Validate incoming request


    //     $validator = Validator::make($request->all(), [
    //         'title' => 'required|string|max:255',
    //         'description' => 'nullab    le|string',
    //         'duration' => 'nullable|integer|min:1',
    //     ]);

    //     // if ($validator->fails()) {
    //     //     return redirect()->back()
    //     //         ->withErrors($validator)
    //     //         ->withInput();
    //     // }

    //     if ($validator->passes()) {
    //         if (request()->hasfile('image')) {
    //             $fileName = time() . '.' . $request->image->extension();
    //             $request->image->storeAs('public/images', $fileName);
    //         }
    //         $course = new Course;
    //         $course->title = $request->input('title');
    //         $course->description = $request->input('description');
    //         $course->duration = $request->input('duration');
    //         // $course->image = $fileName;
    //         $course->save();



    //         return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    //     } else {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    // }

    public function edit(Course $course)
    {
        return view('manage.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        try {
            // Find the course by ID or fail if not found
            $course = Course::findOrFail($course->id);

            // Validate the incoming request data
            $validator = $this->validateCourse($request);

            // Use database transactions to ensure data consistency
            DB::beginTransaction();

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                // Delete the existing image if any
                if ($course->image) {
                    $this->deleteImage($course->image);
                }

                // Upload and store the new image
                $imageName = $this->storeImage($request->file('image'), $request->name);
                // Generate and store thumbnail
                // $thumbnailPath = $this->generateAndStoreThumbnail($image, $imageName);
                // Update image name
                $course->image = $imageName;
            } elseif ($request->has('remove_image')) {
                // Remove the existing image if requested
                if ($course->image) {
                    $this->deleteImage($course->image);
                    $course->image = null; // Set image name to null in the database
                }
            }

            // Update the course attributes
            $course->name = $request->name;
            $course->description = $request->description;
            $course->duration = $request->duration;
            $course->category = $request->category;
            $course->level = $request->level;
            $course->instructor = $request->instructor;
            $course->price = $request->price;
            $course->start_date = $request->start_date;
            $course->end_date = $request->end_date;

            // Save the course
            $course->save();

            // Commit the transaction
            DB::commit();
            // dd("wow");
            // Redirect with success message
            return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Record not found exception
            return redirect()->route('courses.index')->with('error', 'Course not found.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation error
            return redirect()->back()->withInput()->withErrors($e->validator->errors()->all());
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            // Log the error
            Log::error('Error updating course: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred while updating course. Please try again.']);
        }
    }

    public function show(Course $courses, $name)
    {
        $course = Course::where('name', $name)->firstOrFail();

        // Log the user activity with the route name and resource name
        // activity()->log('Viewed resource: ' . $resource->name);

        return view('course.show', compact('course'));
    }


    public function destroy(Course $course)
    {
        try {
            // Use database transaction to ensure data consistency
            DB::beginTransaction();

            // Delete the image associated with the course, if it exists
            if ($course->image) {
                $this->deleteImage($course->image);
            }

            // Delete the course
            $course->delete();

            // Commit the transaction
            DB::commit();

            // Redirect with success message
            return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            // Log the error
            Log::error('Error deleting course: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->withErrors(['error' => 'Error occurred while deleting course. Please try again.']);
        }
    }

    private function validateCourse(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer',
            'category' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:255',
            'instructor' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }


    // Helper method to delete an image
    private function deleteImage($imagePath)
    {
        try {
            // Check if the image exists before attempting deletion
            if (Storage::disk('public')->exists('courses/' . $imagePath)) {
                // Attempt to delete the image
                Storage::disk('public')->delete('courses/' . $imagePath);
                Log::info('Original image deleted successfully: ' . $imagePath);
            } else {
                Log::warning('Original image does not exist: ' . $imagePath);
            }

            // Check if the thumbnail exists before attempting deletion
            $thumbnailPath = 'courses/thumbnails/' . $imagePath;
            if (Storage::disk('public')->exists($thumbnailPath)) {
                // Attempt to delete the thumbnail
                Storage::disk('public')->delete($thumbnailPath);
                Log::info('Thumbnail image deleted successfully: ' . $thumbnailPath);
            } else {
                Log::warning('Thumbnail image does not exist: ' . $thumbnailPath);
            }
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to delete image: ' . $e->getMessage());
        }
    }

    // Helper method to store an image
    private function storeImage($image, $name)
    {
        try {
            $imageName = Str::slug($name) . '_' . now()->format('YmdHis') . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('courses', $imageName, 'public');
            // Generate and store thumbnail
            $thumbnailPath = $this->generateAndStoreThumbnail($image, $imageName);
            Log::info('Image stored successfully: ' . $imagePath);
            return $imageName;
        } catch (\Exception $e) {
            Log::error('Failed to store image: ' . $e->getMessage());
            return null;
        }
    }
}
