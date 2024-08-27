<?php

namespace App\Http\Controllers\Data;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AcademicEntity;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AcademicEntityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academicEntity = AcademicEntity::all();
        return view('manage.academics.index', compact('academicEntity'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        // Predefined values for each field
        // $predefinedValues = [
        //     'category' => ['Undergraduate', 'Postgraduate', 'PhD', 'PG Diploma', 'Diploma', 'Certificate'],
        //     'institute' => ['RNTU Bhopal MP', 'CVRU Bilaspur CG', 'CVRU Khandwa MP', 'CVRU Vaishali Bihar', 'AISECT Hazaribag Jharkhand'],
        //     'faculty' => ['Agriculture', 'Humanities & Languages', 'Commerce', 'Information Technology', 'Education', 'Engineering & Technologies', 'Law', 'Management', 'Medical Science', 'Science', 'Online Resources', 'MOOCS', 'Konnect', 'Vocational Education', 'Industries Partners'],
        //     // 'department' => ['Option10', 'Option11', 'Option12'],
        //     'department' => [
        //         'Agriculture', 'Humanities & Languages', 'Commerce', 'Information Technology',
        //         'Education', 'Engineering & Technologies', 'Law', 'Management', 'Medical Science',
        //         'Science', 'Online Resources', 'MOOCS', 'Konnect', 'Vocational Education', 'Industries Partners',
        //         'Science', 'Engineering', 'Law', 'Arts', 'Commerce & Management',
        //         'Education and Physical Education', 'Information Technology', 'Pharmacy',
        //         'Agriculture', 'Arts & Humanities', 'Commerce', 'Computer Science & IT',
        //         'Management', 'Paramedical Science', 'Science', 'Education', 'Vocational Education',
        //         'Digital Learning', 'Home Science', 'Rural Technology', 'Rural Management',
        //         'Food Science', 'Dairy Science & Technology',
        //         'Engineering Technology', 'Agriculture', 'Arts', 'Humanities', 'Commerce',
        //         'Information Technology', 'Management', 'Science',
        //         'Agriculture', 'Arts', 'Commerce', 'Computer Science & IT', 'Management',
        //         'Journalism & Mass Communication', 'Science', 'Yoga & Naturopathy', 'Fine Arts',
        //         'Performing Arts',
        //     ],
        //     'course' => [
        //         'B.Sc. Agriculture', 'M.Sc. Agriculture', 'Ph.D. in Agriculture',
        //         'B.A. in English Literature', 'M.A. in Hindi Literature', 'Ph.D. in History',
        //         'B.Com', 'M.Com', 'MBA', 'Ph.D. in Commerce',
        //         'B.Tech in Computer Science', 'M.Tech in Information Technology', 'Ph.D. in Computer Science',
        //         'B.Ed', 'M.Ed', 'Ph.D. in Education',
        //         'B.Tech in Mechanical Engineering', 'M.Tech in Civil Engineering', 'Ph.D. in Electrical Engineering',
        //         'LLB', 'LLM', 'Ph.D. in Law',
        //         'BBA', 'MBA', 'Ph.D. in Management',
        //         'MBBS', 'MD', 'MS', 'Ph.D. in Medical Science',
        //         'B.Sc. in Physics', 'M.Sc. in Chemistry', 'Ph.D. in Biology',
        //         'Online Courses', 'Webinars', 'Virtual Labs',
        //         'Various MOOCs',
        //         'Networking', 'Telecommunications', 'Internet Technology',
        //         'Vocational Certificates', 'Skill Development Courses',
        //         'Industry-Specific Training Programs', 'Corporate Workshops'
        //     ],
        // ];

        // // Fetch distinct values for each field
        // $distinctValues = [];
        // // $fields = ['category', 'institute', 'faculty', 'department', 'course'];
        // $fields = array_keys($predefinedValues);

        // foreach ($fields as $field) {
        //     $distinctValues[$field] = AcademicEntity::distinct()->pluck($field);
        // }

        // return view('manage.academics.create', compact('predefinedValues','distinctValues'));

        $predefinedValues = $this->getPredefinedValues();
        // Fetch distinct values for each field from the database
        $fields = array_keys($predefinedValues);

        foreach ($fields as $field) {
            $distinctValues[$field] = AcademicEntity::distinct()->pluck($field)->toArray();
        }

        // Merge fetched values with predefined values for each field
        foreach ($fields as $field) {
            $mergedValues = array_merge($predefinedValues[$field], $distinctValues[$field]);
            // Remove duplicates
            $predefinedValues[$field] = array_unique($mergedValues);
        }

        return view('manage.academics.create', compact('predefinedValues'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = $this->validateAcademicEntity($request);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        try {
            // Use database transactions to ensure data consistency
            DB::beginTransaction();

            // Create a new academic entity instance
            $academicEntity = new AcademicEntity();

            // Store the image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Str::slug($request->name) . '_' . now()->format('YmdHis') . '.' . $image->getClientOriginalExtension();

                // Store original image
                $imagePath = $image->storeAs('academics', $imageName, 'public');

                // Generate and store thumbnail
                $thumbnailPath = $this->generateAndStoreThumbnail($image, $imageName);

                // Extract filename from the full path
                $imageNameOnly = pathinfo($imagePath, PATHINFO_BASENAME);

                // Save only the image name to the course model
                $academicEntity->image = $imageNameOnly;
            }


            // Update the academic entity with request data
            $this->updateAcademicEntityFields($request, $academicEntity);

            $academicEntity->save();

            // Commit the transaction
            DB::commit();

            // Redirect with success message
            return redirect()->route('academics.index')->with('success', 'Academic entity created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            // Log the error
            // Log::error('Error creating academic entity: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred while creating academic entity. Please try again.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicEntity $academicEntity)
    {
        $academicEntity = AcademicEntity::where('category', $academicEntity)->firstOrFail();

        // Log the user activity with the route name and resource name
        // activity()->log('Viewed resource: ' . $resource->name);

        return view('course.show', compact('academicEntity'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($academic)
    {
        $academicEntity = AcademicEntity::findOrFail($academic);
        // Predefined values for each field
        $predefinedValues = [
            'category' => ['Undergraduate', 'Postgraduate', 'PhD', 'PG Diploma', 'Diploma', 'Certificate'],
            'institute' => ['RNTU Bhopal MP', 'CVRU Bilaspur CG', 'CVRU Khandwa MP', 'CVRU Vaishali Bihar', 'AISECT Hazaribag Jharkhand'],
            'faculty' => ['Agriculture', 'Humanities & Languages', 'Commerce', 'Information Technology', 'Education', 'Engineering & Technologies', 'Law', 'Management', 'Medical Science', 'Science', 'Online Resources', 'MOOCS', 'Konnect', 'Vocational Education', 'Industries Partners'],
            'department' => [
                'Agriculture', 'Humanities & Languages', 'Commerce', 'Information Technology',
                'Education', 'Engineering & Technologies', 'Law', 'Management', 'Medical Science',
                'Science', 'Online Resources', 'MOOCS', 'Konnect', 'Vocational Education', 'Industries Partners',
                'Science', 'Engineering', 'Law', 'Arts', 'Commerce & Management',
                'Education and Physical Education', 'Information Technology', 'Pharmacy',
                'Agriculture', 'Arts & Humanities', 'Commerce', 'Computer Science & IT',
                'Management', 'Paramedical Science', 'Science', 'Education', 'Vocational Education',
                'Digital Learning', 'Home Science', 'Rural Technology', 'Rural Management',
                'Food Science', 'Dairy Science & Technology',
                'Engineering Technology', 'Agriculture', 'Arts', 'Humanities', 'Commerce',
                'Information Technology', 'Management', 'Science',
                'Agriculture', 'Arts', 'Commerce', 'Computer Science & IT', 'Management',
                'Journalism & Mass Communication', 'Science', 'Yoga & Naturopathy', 'Fine Arts',
                'Performing Arts',
            ],
            'course' => [
                'B.Sc. Agriculture', 'M.Sc. Agriculture', 'Ph.D. in Agriculture',
                'B.A. in English Literature', 'M.A. in Hindi Literature', 'Ph.D. in History',
                'B.Com', 'M.Com', 'MBA', 'Ph.D. in Commerce',
                'B.Tech in Computer Science', 'M.Tech in Information Technology', 'Ph.D. in Computer Science',
                'B.Ed', 'M.Ed', 'Ph.D. in Education',
                'B.Tech in Mechanical Engineering', 'M.Tech in Civil Engineering', 'Ph.D. in Electrical Engineering',
                'LLB', 'LLM', 'Ph.D. in Law',
                'BBA', 'MBA', 'Ph.D. in Management',
                'MBBS', 'MD', 'MS', 'Ph.D. in Medical Science',
                'B.Sc. in Physics', 'M.Sc. in Chemistry', 'Ph.D. in Biology',
                'Online Courses', 'Webinars', 'Virtual Labs',
                'Various MOOCs',
                'Networking', 'Telecommunications', 'Internet Technology',
                'Vocational Certificates', 'Skill Development Courses',
                'Industry-Specific Training Programs', 'Corporate Workshops'
            ],
        ];

        // Fetch distinct values for each field from the database
        // Fetch distinct values for each field from the database
        // Fetch distinct values for each field
        $distinctValues = [];
        $fields = array_keys($predefinedValues);

        foreach ($fields as $field) {
            $distinctValues[$field] = AcademicEntity::distinct()->pluck($field)->toArray();
        }

        // Merge fetched values with predefined values for each field
        foreach ($fields as $field) {
            $mergedValues = array_merge($predefinedValues[$field], $distinctValues[$field]);
            // Remove duplicates
            $predefinedValues[$field] = array_unique($mergedValues);
        }

        return view('manage.academics.edit', compact('academicEntity', 'predefinedValues'));
    }

    /**
     * Update the specified resource in storage.
     */

    // Update an existing academic entity
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validator = $this->validateAcademicEntity($request);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        try {
            // Use database transactions to ensure data consistency
            DB::beginTransaction();



            // Find the academic entity to update
            $academicEntity = AcademicEntity::findOrFail($id);

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                // Delete the existing image if any
                if ($academicEntity->image) {
                    $this->deleteImage($academicEntity->image);
                }

                // Upload and store the new image
                $imageName = $this->storeImage($request->file('image'), $request->name);
                // Generate and store thumbnail
                // $thumbnailPath = $this->generateAndStoreThumbnail($image, $imageName);
                // Update image name
                $academicEntity->image = $imageName;
            } elseif ($request->has('remove_image')) {
                // Remove the existing image if requested
                if ($academicEntity->image) {
                    $this->deleteImage($academicEntity->image);
                    $academicEntity->image = null; // Set image name to null in the database
                }
            }

            // Update the academic entity with request data
            $this->updateAcademicEntityFields($request, $academicEntity);

            $academicEntity->save();

            // Commit the transaction
            DB::commit();

            // Redirect with success message
            return redirect()->route('academics.index')->with('success', 'Academic entity updated successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            // Log the error
            // Log::error('Error updating academic entity: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred while updating academic entity. Please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($academic)
    {
        // Find the record by a$academic
        $academicEntity = AcademicEntity::findOrFail($academic);

        // Delete the record
        $academicEntity->delete();

        // Redirect back with a success message
        return redirect()->route('academics.index')->with('success', 'Academic Record deleted successfully');
    }

    // Update the academic entity fields with request data
    private function updateAcademicEntityFields(Request $request, AcademicEntity $academicEntity)
    {
        $fields = [
            'category', 'institute', 'faculty', 'department', 'course'
        ];

        foreach ($fields as $field) {
            if ($request->input($field) === 'custom') {
                $customField = "custom_$field";
                $academicEntity->$field = $request->input($customField);
            } else {
                $academicEntity->$field = $request->input($field);
            }
        }
    }

    // Validate the academic entity data
    private function validateAcademicEntity(Request $request)
    {
        return Validator::make($request->all(), [
            'category' => 'required|string|max:255',
            'institute' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            // Additional validation rules for custom fields
            'custom_category' => 'nullable|string|max:255|required_if:category,custom',
            'custom_institute' => 'nullable|string|max:255|required_if:institute,custom',
            'custom_faculty' => 'nullable|string|max:255|required_if:faculty,custom',
            'custom_department' => 'nullable|string|max:255|required_if:department,custom',
            'custom_course' => 'nullable|string|max:255|required_if:course,custom',

            'image' => 'nullable|'
        ]);
    }

    private function getPredefinedValues()
    {
        return [
            'category' => ['Undergraduate', 'Postgraduate', 'PhD', 'PG Diploma', 'Diploma', 'Certificate'],
            'institute' => ['RNTU Bhopal MP', 'CVRU Bilaspur CG', 'CVRU Khandwa MP', 'CVRU Vaishali Bihar', 'AISECT Hazaribag Jharkhand'],
            'faculty' => ['Agriculture', 'Humanities & Languages', 'Commerce', 'Information Technology', 'Education', 'Engineering & Technologies', 'Law', 'Management', 'Medical Science', 'Science', 'Online Resources', 'MOOCS', 'Konnect', 'Vocational Education', 'Industries Partners'],
            'department' => [
                'Agriculture', 'Humanities & Languages', 'Commerce', 'Information Technology',
                'Education', 'Engineering & Technologies', 'Law', 'Management', 'Medical Science',
                'Science', 'Online Resources', 'MOOCS', 'Konnect', 'Vocational Education', 'Industries Partners',
                'Science', 'Engineering', 'Law', 'Arts', 'Commerce & Management',
                'Education and Physical Education', 'Information Technology', 'Pharmacy',
                'Agriculture', 'Arts & Humanities', 'Commerce', 'Computer Science & IT',
                'Management', 'Paramedical Science', 'Science', 'Education', 'Vocational Education',
                'Digital Learning', 'Home Science', 'Rural Technology', 'Rural Management',
                'Food Science', 'Dairy Science & Technology',
                'Engineering Technology', 'Agriculture', 'Arts', 'Humanities', 'Commerce',
                'Information Technology', 'Management', 'Science',
                'Agriculture', 'Arts', 'Commerce', 'Computer Science & IT', 'Management',
                'Journalism & Mass Communication', 'Science', 'Yoga & Naturopathy', 'Fine Arts',
                'Performing Arts',
            ],
            'course' => [
                'B.Sc. Agriculture', 'M.Sc. Agriculture', 'Ph.D. in Agriculture',
                'B.A. in English Literature', 'M.A. in Hindi Literature', 'Ph.D. in History',
                'B.Com', 'M.Com', 'MBA', 'Ph.D. in Commerce',
                'B.Tech in Computer Science', 'M.Tech in Information Technology', 'Ph.D. in Computer Science',
                'B.Ed', 'M.Ed', 'Ph.D. in Education',
                'B.Tech in Mechanical Engineering', 'M.Tech in Civil Engineering', 'Ph.D. in Electrical Engineering',
                'LLB', 'LLM', 'Ph.D. in Law',
                'BBA', 'MBA', 'Ph.D. in Management',
                'MBBS', 'MD', 'MS', 'Ph.D. in Medical Science',
                'B.Sc. in Physics', 'M.Sc. in Chemistry', 'Ph.D. in Biology',
                'Online Courses', 'Webinars', 'Virtual Labs',
                'Various MOOCs',
                'Networking', 'Telecommunications', 'Internet Technology',
                'Vocational Certificates', 'Skill Development Courses',
                'Industry-Specific Training Programs', 'Corporate Workshops'
            ],
        ];
    }

    // Helper method to delete an image
    private function deleteImage($imagePath)
    {
        try {
            // Check if the image exists before attempting deletion
            if (Storage::disk('public')->exists('academics/' . $imagePath)) {
                // Attempt to delete the image
                Storage::disk('public')->delete('academics/' . $imagePath);
                Log::info('Original image deleted successfully: ' . $imagePath);
            } else {
                Log::warning('Original image does not exist: ' . $imagePath);
            }

            // Check if the thumbnail exists before attempting deletion
            $thumbnailPath = 'academics/thumbnails/' . $imagePath;
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
            $imagePath = $image->storeAs('academics', $imageName, 'public');
            // Generate and store thumbnail
            $thumbnailPath = $this->generateAndStoreThumbnail($image, $imageName);
            Log::info('Image stored successfully: ' . $imagePath);
            return $imageName;
        } catch (\Exception $e) {
            Log::error('Failed to store image: ' . $e->getMessage());
            return null;
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
            $thumbnailPath = 'public/academics/thumbnails/' . $thumbnailName;
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

    // public function edit($academic)
    // {
    //     $academicEntity = AcademicEntity::findOrFail($academic);
    //     $categories = AcademicEntity::distinct()->pluck('category'); // Fetch distinct categories

    //     return view('manage.academics.edit', compact('academicEntity', 'categories'));
    // }

    // public function edit($academic)
    // {
    //     $academicEntity = AcademicEntity::findOrFail($academic);
    //     $fields = ['category', 'institute', 'faculty', 'department', 'course'];
    //     $distinctValues = [];

    //     foreach ($fields as $field) {
    //         $distinctValues[$field] = AcademicEntity::distinct()->pluck($field);
    //     }

    //     return view('manage.academics.edit', compact('academicEntity', 'distinctValues'));
    // }

    // public function store(Request $request)
    // {
    //     // Validate the incoming request data
    //     $validator = $this->validateAcademicEntity($request);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator->errors())->withInput();
    //     }

    //     try {
    //         // Use database transactions to ensure data consistency
    //         DB::beginTransaction();

    //         // Create the academic entity
    //         $academicEntity = new AcademicEntity();
    //         $academicEntity->category = $request->category;
    //         $academicEntity->institute = $request->institute;
    //         $academicEntity->faculty = $request->faculty;
    //         $academicEntity->department = $request->department;
    //         $academicEntity->course = $request->course;

    //         // If custom option is selected, replace with custom values
    //         if ($request->category === 'custom') {
    //             $academicEntity->category = $request->custom_category;
    //         }
    //         if ($request->institute === 'custom') {
    //             $academicEntity->institute = $request->custom_institute;
    //         }
    //         if ($request->faculty === 'custom') {
    //             $academicEntity->faculty = $request->custom_faculty;
    //         }
    //         if ($request->department === 'custom') {
    //             $academicEntity->department = $request->custom_department;
    //         }
    //         if ($request->course === 'custom') {
    //             $academicEntity->course = $request->custom_course;
    //         }

    //         $academicEntity->save();

    //         // Commit the transaction
    //         DB::commit();

    //         // Redirect with success message
    //         return redirect()->route('academics.index')->with('success', 'Academic entity created successfully.');
    //     } catch (\Exception $e) {
    //         // Rollback the transaction in case of an error
    //         DB::rollBack();

    //         // Log the error
    //         // Log::error('Error creating academic entity: ' . $e->getMessage());

    //         // Redirect back with error message
    //         return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred while creating academic entity. Please try again.']);
    //     }
    // }


    // private function validateAcademicEntity(Request $request)
    // {
    //     return Validator::make($request->all(), [
    //         'category' => 'nullable|string|max:255',
    //         'institute' => 'required|string|max:255',
    //         'faculty' => 'required|string|max:255',
    //         'department' => 'nullable|string|max:255',
    //         'course' => 'nullable|string|max:255',
    //         // Additional validation rules for custom fields
    //         'custom_category' => 'nullable|string|max:255|required_if:category,custom',
    //         'custom_institute' => 'nullable|string|max:255|required_if:institute,custom',
    //         'custom_faculty' => 'nullable|string|max:255|required_if:faculty,custom',
    //         'custom_department' => 'nullable|string|max:255|required_if:department,custom',
    //         'custom_course' => 'nullable|string|max:255|required_if:course,custom',
    //     ]);
    // }

    // private function prepareDataForStorage(Request $request)
    // {
    //     $data = [
    //         'category' => $request->input('category'),
    //         'institute' => $request->input('institute'),
    //         'faculty' => $request->input('faculty'),
    //         'department' => $request->input('department'),
    //         'course' => $request->input('course'),
    //     ];

    //     // If custom option selected, replace with custom values
    //     if ($request->input('category') === 'custom') {
    //         $data['category'] = $request->input('custom_category');
    //     }
    //     if ($request->input('institute') === 'custom') {
    //         $data['institute'] = $request->input('custom_institute');
    //     }
    //     if ($request->input('faculty') === 'custom') {
    //         $data['faculty'] = $request->input('custom_faculty');
    //     }
    //     if ($request->input('department') === 'custom') {
    //         $data['department'] = $request->input('custom_department');
    //     }
    //     if ($request->input('course') === 'custom') {
    //         $data['course'] = $request->input('custom_course');
    //     }

    //     return $data;
    // }

    // Complete with predefined data
    // public function create()
    // {
    //     // Predefined values for each field
    //     $predefinedValues = [
    //         'category' => ['Undergraduate', 'Postgraduate', 'PhD', 'PG Diploma', 'Diploma', 'Certificate'],
    //         'institute' => ['RNTU Bhopal MP', 'CVRU Bilaspur CG', 'CVRU Khandwa MP', 'CVRU Vaishali Bihar', 'AISECT Hazaribag Jharkhand'],
    //         'faculty' => ['Agriculture', 'Humanities & Languages', 'Commerce', 'Information Technology', 'Education', 'Engineering & Technologies', 'Law', 'Management', 'Medical Science', 'Science', 'Online Resources', 'MOOCS', 'Konnect', 'Vocational Education', 'Industries Partners'],
    //         // 'department' => ['Option10', 'Option11', 'Option12'],
    //         'department' => [
    //             'Agriculture', 'Humanities & Languages', 'Commerce', 'Information Technology',
    //             'Education', 'Engineering & Technologies', 'Law', 'Management', 'Medical Science',
    //             'Science', 'Online Resources', 'MOOCS', 'Konnect', 'Vocational Education', 'Industries Partners',
    //             'Science', 'Engineering', 'Law', 'Arts', 'Commerce & Management',
    //             'Education and Physical Education', 'Information Technology', 'Pharmacy',
    //             'Agriculture', 'Arts & Humanities', 'Commerce', 'Computer Science & IT',
    //             'Management', 'Paramedical Science', 'Science', 'Education', 'Vocational Education',
    //             'Digital Learning', 'Home Science', 'Rural Technology', 'Rural Management',
    //             'Food Science', 'Dairy Science & Technology',
    //             'Engineering Technology', 'Agriculture', 'Arts', 'Humanities', 'Commerce',
    //             'Information Technology', 'Management', 'Science',
    //             'Agriculture', 'Arts', 'Commerce', 'Computer Science & IT', 'Management',
    //             'Journalism & Mass Communication', 'Science', 'Yoga & Naturopathy', 'Fine Arts',
    //             'Performing Arts',
    //         ],
    //         'course' => [
    //             'B.Sc. Agriculture', 'M.Sc. Agriculture', 'Ph.D. in Agriculture',
    //             'B.A. in English Literature', 'M.A. in Hindi Literature', 'Ph.D. in History',
    //             'B.Com', 'M.Com', 'MBA', 'Ph.D. in Commerce',
    //             'B.Tech in Computer Science', 'M.Tech in Information Technology', 'Ph.D. in Computer Science',
    //             'B.Ed', 'M.Ed', 'Ph.D. in Education',
    //             'B.Tech in Mechanical Engineering', 'M.Tech in Civil Engineering', 'Ph.D. in Electrical Engineering',
    //             'LLB', 'LLM', 'Ph.D. in Law',
    //             'BBA', 'MBA', 'Ph.D. in Management',
    //             'MBBS', 'MD', 'MS', 'Ph.D. in Medical Science',
    //             'B.Sc. in Physics', 'M.Sc. in Chemistry', 'Ph.D. in Biology',
    //             'Online Courses', 'Webinars', 'Virtual Labs',
    //             'Various MOOCs',
    //             'Networking', 'Telecommunications', 'Internet Technology',
    //             'Vocational Certificates', 'Skill Development Courses',
    //             'Industry-Specific Training Programs', 'Corporate Workshops'
    //         ],
    //     ];

    //     // // Fetch distinct values for each field
    //     // $distinctValues = [];
    //     // // $fields = ['category', 'institute', 'faculty', 'department', 'course'];
    //     // $fields = array_keys($predefinedValues);

    //     // foreach ($fields as $field) {
    //     //     $distinctValues[$field] = AcademicEntity::distinct()->pluck($field);
    //     // }

    //     // return view('manage.academics.create', compact('predefinedValues','distinctValues'));

    //     // Fetch distinct values for each field from the database
    //     // Fetch distinct values for each field from the database
    //     $fields = array_keys($predefinedValues);

    //     foreach ($fields as $field) {
    //         $distinctValues[$field] = AcademicEntity::distinct()->pluck($field)->toArray();
    //     }

    //     // Merge fetched values with predefined values for each field
    //     foreach ($fields as $field) {
    //         $mergedValues = array_merge($predefinedValues[$field], $distinctValues[$field]);
    //         // Remove duplicates
    //         $predefinedValues[$field] = array_unique($mergedValues);
    //     }

    //     return view('manage.academics.create', compact('predefinedValues'));
    // }
}
