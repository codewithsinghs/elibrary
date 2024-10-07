<?php

namespace App\Http\Controllers\Data;

use Exception;
use Throwable;
use App\Models\Resource;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resources = Resource::all();
        return view('manage.resources.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manage.resources.create');
    }

    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'name' => 'required|string|max:255',
                'caption' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'category' => 'required|string|max:255',
                'author' => 'nullable|string|max:255',
                'url' => 'required|url',
                'published_at' => 'nullable|date',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
            ]);

            // Use database transactions to ensure data consistency
            DB::beginTransaction();

            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Str::slug($request->name) . '_' . now()->format('YmdHis') . '.' . $image->getClientOriginalExtension();

                $imagePath = $image->storeAs('resources', $imageName, 'public');

                // Generate and store thumbnail
                $thumbnailPath = $this->generateAndStoreThumbnail($image, $imageName);

                $imagePath =  $imageName;
            }

            // Store the resource
            // Resource::create($request->all());

            $resource = new Resource();
            $resource->name = $request->name;
            $resource->slug = Str::slug($resource->name); // Generate a slug from the name
            $resource->caption = $request->caption;
            $resource->description = $request->description;
            $resource->url = $request->url;
            $resource->category = $request->category;
            $resource->author = $request->author;
            $resource->published_at = $request->published_at;
            $resource->image = $imagePath;
            // $resource->thumbnail = $request->thumbnail;
            // Save resource
            $resource->save();

            // Commit the transaction
            DB::commit();

            // Redirect with success message
            return redirect()->route('resources.index')->with('success', 'Resource created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation error
            return redirect()->back()->withInput()->withErrors($e->validator->errors()->all());
        } catch (Throwable $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            // Log the error
            Log::error('Error storing resource: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred while creating resource. Please try again.']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     // Validate incoming request
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'caption' => 'nullable|string|max:255',
    //         'description' => 'nullable|string',
    //         'category' => 'required|string|max:255',
    //         'author' => 'nullable|string|max:255',
    //         'url' => 'required|url',
    //         'published_at' => 'nullable|date',
    //         'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     // Check for validation errors
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     try {
    //         // Begin transaction
    //         DB::beginTransaction();

    //         // Handle image upload
    //     $thumbnailPath = null;
    //     if ($request->hasFile('thumbnail')) {
    //         $thumbnail = $request->file('thumbnail');
    //         $imageName = Str::slug($request->name) . '_' . now()->format('YmdHis') . '.' . $thumbnail->getClientOriginalExtension();
    //         $thumbnail->move(public_path('assets/img/uploaded/resources'), $imageName);
    //         $thumbnailPath = 'assets/img/uploaded/resources/' . $imageName;
    //     }

    //         // Create resource instance
    //         $resource = new Resource();
    //         $resource->name = $request->name;
    //         $resource->caption = $request->caption;
    //         $resource->description = $request->description;
    //         $resource->url = $request->url;
    //         $resource->category = $request->category;
    //         $resource->author = $request->author;
    //         $resource->published_at = $request->published_at;
    //         $resource->thumbnail = $thumbnailPath;

    //         // Save resource
    //         $resource->save();

    //         // Commit transaction
    //         DB::commit();

    //         return redirect()->route('resources.index')->with('success', 'Resource created successfully.');
    //     } catch (\Exception $e) {
    //         // Rollback transaction on failure
    //         DB::rollBack();

    //         // Log error
    //        // Log::error('Failed to create resource: ' . $e->getMessage());

    //         return redirect()->back()->withInput()->with('error', 'Failed to create resource. Please try again.');
    //     }
    // }


    // public function store(Request $request)
    // {

    //     // Validate incoming request
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'caption' => 'nullable|string|max:255',
    //         'description' => 'nullable|string',
    //         'url' => 'nullable|url',
    //         'published_at' => 'nullable|date',
    //         'category' => 'nullable|string|max:255',
    //         'author' => 'nullable|string|max:255',
    //         'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    //     ]);

    //     // Check for validation errors
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     // // Handle image upload if provided
    //     $thumbnailPath = null;
    //     // if ($request->hasFile('thumbnail')) {
    //     //     $thumbnail = $request->file('thumbnail');
    //     //     $imageName = Str::slug($request->name) . '_' . now()->format('YmdHis') . '.' . $thumbnail->getClientOriginalExtension();
    //     //     $thumbnail->storeAs('public/assets/img/uploaded/resources', $imageName);
    //     //     $thumbnailPath = $imageName;
    //     // }

    //     // Check if the resource already exists
    //     // $existingResource = Resource::where('name', $request->name)->first();
    //     // if ($existingResource) {
    //     //     throw new \Exception('Resource already exists.');
    //     // }

    //     // Create resource in the database
    //     $resource = Resource::create([
    //         'name' => $request->name,
    //         'caption' => $request->caption,
    //         'description' => $request->description,
    //         'category' => $request->category,
    //         'author' => $request->author,
    //         'url' => $request->url,
    //         'published_at' => $request->published_at,
    //         'thumbnail' => $thumbnailPath
    //     ]);

    //     return redirect()->route('resources.index')->with('success', 'Resource created successfully.');
    // }


    // public function store(Request $request)
    // {
    //     try {
    //         // Define validation rules
    //         $validator = Validator::make($request->all(), [
    //             'name' => 'required|string|max:255',
    //             'caption' => 'nullable|string|max:255',
    //             'description' => 'nullable|string',
    //             'category' => 'required|string|max:255',
    //             'author' => 'nullable|string|max:255',
    //             'url' => 'required|url',
    //             'published_at' => 'nullable|date',
    //             'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
    //         ]);

    //         if ($validator->passes()) {

    //             $resource = Resource::create($request->post());


    //             $imageName = null;

    //             if ($request->hasFile('thumbnail')) {

    //                 $thumbnail = $request->file('thumbnail');
    //                 $ext = $thumbnail->getClientOriginalExtension();
    //                 $imageName = Str::slug($request->name) . '_' . now()->format('Ymd') . '.' . $ext;
    //                 $request->thumbnail->move(public_path() . 'build/assets/img/uploads/resources/', $imageName); // This will save file to this location
    //                 $resource->image = $imageName;
    //                 $resource->save();
    //             }

    //             return redirect()->route('resources.index')->with('success', 'Resource created successfully.');
    //         }

    //         // Check if validation fails
    //         else {
    //             return redirect()->back()->withErrors($validator)->withInput();
    //         }
    //     } catch (\Exception $e) {
    //         // Log error
    //         DB::rollBack();

    //         return redirect()->back()->withInput()->with('error', 'Failed to validate resource. Please try again.');
    //     }
    // }



    /**
     * Display the specified resource.
     */
    public function show(Resource $resource, $name)
    {
        $resource = Resource::where('name', $name)->firstOrFail();

        // Log the user activity with the route name and resource name
        // activity()->log('Viewed resource: ' . $resource->name);

        return view('resource.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        return view('manage.resources.edit', compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Resource $resource)
    // {

    //     try {
    //         // Validate the incoming request data
    //         $request->validate([
    //             'name' => 'required|string|max:255',
    //             'caption' => 'nullable|string|max:255',
    //             'description' => 'nullable|string',
    //             'category' => 'required|string|max:255',
    //             'author' => 'nullable|string|max:255',
    //             'url' => 'required|url',
    //             'published_at' => 'nullable|date',
    //             'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         ]);

    //         // Use database transactions to ensure data consistency
    //         DB::beginTransaction();

    //         // Find the resource by ID
    //         $resource = Resource::findOrFail($resource);

    //         // Update the resource fields
    //         $resource->update($request->except('thumbnail'));

    //         // Handle image upload if present
    //         if ($request->hasFile('thumbnail')) {
    //             $image = $request->file('thumbnail');
    //             $imageName = Str::slug($request->name) . '_' . now()->format('YmdHis') . '.' . $image->getClientOriginalExtension();
    //             $image->storeAs('img/uploaded/resources', $imageName);
    //             $resource->thumbnail = $imageName;
    //             $resource->save();
    //         }

    //         // Commit the transaction
    //         DB::commit();

    //         // Redirect with success message
    //         return redirect()->route('resources.index')->with('success', 'Resource updated successfully.');
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         // Validation error
    //         return redirect()->back()->withInput()->withErrors($e->validator->errors()->all());
    //     } catch (\Exception $e) {
    //         // Rollback the transaction in case of an error
    //         DB::rollBack();

    //         // Log the error
    //         Log::error('Error updating resource: ' . $e->getMessage());

    //         // Redirect back with error message
    //         return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred while updating resource. Please try again.']);
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        // Check if the resource has an associated image
        if ($resource->thumbnail) {
            // Construct the image path
            $imagePath = 'public/' . $resource->thumbnail;

            // Check if the image exists in storage
            if (Storage::exists($imagePath)) {
                // Attempt to delete the image from storage
                try {
                    Storage::delete($imagePath);
                    Log::info('Image deleted successfully: ' . $imagePath);
                } catch (\Exception $e) {
                    Log::error('Failed to delete image: ' . $e->getMessage());
                }
            } else {
                Log::error('Image not found: ' . $imagePath);
            }
        } else {
            Log::info('Resource does not have an associated image.');
        }

        // Delete the resource
        $resource->delete();

        return redirect()->route('resources.index')->with('success', 'Resource deleted successfully.');
    }

    public function update(Request $request, Resource $resource)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'name' => 'required|string|max:255',
                'caption' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'category' => 'required|string|max:255',
                'author' => 'nullable|string|max:255',
                'url' => 'required|url',
                'published_at' => 'nullable|date',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
            ]);

            // Use database transactions to ensure data consistency
            DB::beginTransaction();

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                // Delete the existing image if any
                if ($resource->image) {
                    $this->deleteImage($resource->image);
                }

                // Upload and store the new image
                $imageName = $this->storeImage($request->file('image'), $request->name);
                // Generate and store thumbnail
                // $thumbnailPath = $this->generateAndStoreThumbnail($image, $imageName);
                // Update image name
                $resource->image = $imageName;
            } elseif ($request->has('remove_image')) {
                // Remove the existing image if requested
                if ($resource->image) {
                    $this->deleteImage($resource->image);
                    $resource->image = null; // Set image name to null in the database
                }
            }
           
            // $slug = Str::slug($request->name); // Generate a slug from the name

            // Update the resource
            $resource->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'caption' => $request->caption,
                'description' => $request->description,
                'category' => $request->category,
                'author' => $request->author,
                'url' => $request->url,
                'published_at' => $request->published_at,
                // 'image' => $imagePath,
            ]);

            // Commit the transaction
            DB::commit();

            // Redirect with success message
            return redirect()->route('resources.index')->with('success', 'Resource updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation error
            return redirect()->back()->withInput()->withErrors($e->validator->errors()->all());
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            // Log the error
            Log::error('Error updating resource: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred while updating resource. Please try again.']);
        }
    }

    // Helper method to delete an image 29 feb
    // private function deleteImage($imagePath)
    // {
    //     try {
    //         // Check if the image exists before attempting deletion
    //         if (Storage::disk('public')->exists($imagePath)) {
    //             // Attempt to delete the image
    //             Storage::disk('public')->delete($imagePath);
    //             Log::info('Image deleted successfully: ' . $imagePath);
    //         } else {
    //             Log::warning('Image does not exist: ' . $imagePath);
    //         }
    //     } catch (\Exception $e) {
    //         // Log the error
    //         Log::error('Failed to delete image: ' . $e->getMessage());
    //     }
    // }

    // Helper method to store an image 29-feb
    // private function storeImage($image, $name)
    // {
    //     try {
    //         $imageName = Str::slug($name) . '_' . now()->format('YmdHis') . '.' . $image->getClientOriginalExtension();
    //         return $image->storeAs('resources', $imageName, 'public');
    //     } catch (\Exception $e) {
    //         Log::error('Failed to store image: ' . $e->getMessage());
    //         return null;
    //     }
    // }

    private function storeImage($image, $name)
    {
        try {
            $imageName = Str::slug($name) . '_' . now()->format('YmdHis') . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('resources', $imageName, 'public');
            // Generate and store thumbnail
            $thumbnailPath = $this->generateAndStoreThumbnail($image, $imageName);
            // Log::info('Image stored successfully: ' . $imagePath);
            return $imageName;
        } catch (\Exception $e) {
            // Log::error('Failed to store image: ' . $e->getMessage());
            return null;
        }
    }

    private function deleteImage($imagePath)
    {
        try {
            // Check if the image exists before attempting deletion
            if (Storage::disk('public')->exists('resources/' . $imagePath)) {
                // Attempt to delete the image
                Storage::disk('public')->delete('resources/' . $imagePath);
                // Log::info('Original image deleted successfully: ' . $imagePath);
            } else {
                // Log::warning('Original image does not exist: ' . $imagePath);
            }

            // Check if the thumbnail exists before attempting deletion
            $thumbnailPath = 'resources/thumbnails/' . $imagePath;
            if (Storage::disk('public')->exists($thumbnailPath)) {
                // Attempt to delete the thumbnail
                Storage::disk('public')->delete($thumbnailPath);
                //  Log::info('Thumbnail image deleted successfully: ' . $thumbnailPath);
            } else {
                //  Log::warning('Thumbnail image does not exist: ' . $thumbnailPath);
            }
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to delete image: ' . $e->getMessage());
        }
    }

    private function generateAndStoreThumbnail($image, $imageName)
    {
        try {

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
            $thumbnailPath = 'public/resources/thumbnails/' . $thumbnailName;
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
}
