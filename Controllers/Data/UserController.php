<?php

namespace App\Http\Controllers\Data;

use App\Models\User;
use App\Models\Profile;
use App\Models\Guarantor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\AcademicEntity;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('profile')->get(); // Eager loading to avoid N+1 queries
        // dd($users);

        return view('manage.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $academics = AcademicEntity::all();
        return view('manage.users.create', compact('roles', 'academics'));
    }

    /**
     * Store a newly created resource in storage.
     */

    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     try {
    //         // Validate the incoming request data
    //         $validatedUser = $this->validateUser($request);
    //         $validatedProfile = $this->validateProfile($request);

    //         // $validatedGuarantor = $this->validateGurantor($request); // Validate guarantor data
    //         // Use database transactions to ensure data consistency
    //         DB::beginTransaction();

    //         // Create the user
    //         $user = new User();
    //         // $user->name = $request->name;
    //         $user->name = $request->fname . ' ' . $request->lname;
    //         $user->email = $request->email;
    //         $user->password = Hash::make($request->password); // Hash the password
    //         $user->type = 'local';
    //         $user->status = 'active';

    //         $user->save();

    //         // Assign role
    //         $roleName = $request->input('assign_role'); // Assuming 'role' is the input field name
    //         $role = Role::firstOrCreate(['name' => $roleName]);

    //         // Assign the role to the user
    //         $user->assignRole($role);

    //         // // Check if user is successfully created
    //         if ($user) {
    //             // dd($user);
    //             // Store the image
    //             $imageName = null;
    //             if ($request->hasFile('image')) {

    //                 $imageName = $this->storeImage($request->file('image'), $request->name);
    //             }

    //             // Determine the value of member_id based on the provided data
    //             $memberId = $request->filled('enrollment_no') ? $request->enrollment_no : $request->employee_id;
    //             $validatedProfile['member_id'] = $memberId;
    //             //  dd($imageName);
    //             $profile = new Profile();
    //             $profile->user_id = $user->id;
    //             $profile->fname = $validatedProfile['fname'];
    //             $profile->lname = $validatedProfile['fname'];
    //             $profile->email = $user->email;
    //             $profile->dob = $validatedProfile['dob'];
    //             $profile->gender = $validatedProfile['gender'];

    //             $profile->member_type = $validatedProfile['member_type'];
    //             $profile->member_id = $validatedProfile['member_id'];
    //             $profile->year_of_admission = $validatedProfile['year_of_admission'];
    //             $profile->year_of_joining = $validatedProfile['year_of_joining'];

    //             $profile->category = $validatedProfile['category'];
    //             $profile->institute = $validatedProfile['institute'];
    //             $profile->faculty = $validatedProfile['faculty'];
    //             $profile->department = $validatedProfile['department'];
    //             $profile->course = $validatedProfile['course'];
    //             $profile->designation = $validatedProfile['designation'];

    //             $profile->phone = $validatedProfile['phone'];
    //             $profile->alternate_email = $validatedProfile['alternate_email'];

    //             $profile->present_address = $validatedProfile['present_address'];
    //             $profile->present_city = $validatedProfile['present_city'];
    //             $profile->present_pincode = $validatedProfile['present_pincode'];
    //             $profile->permanent_address = $validatedProfile['permanent_address'];
    //             $profile->permanent_city = $validatedProfile['permanent_city'];
    //             $profile->permanent_pincode = $validatedProfile['permanent_pincode'];
    //             $profile->permanent_phone = $validatedProfile['permanent_phone'];


    //             $profile->preferred_genres = $validatedProfile['preferred_genres'] ?? Null;
    //             $profile->preferred_language = $validatedProfile['preferred_language'] ?? Null;

    //             $profile->favorite_resources = $validatedProfile['favorite_resources'] ?? Null;
    //             $profile->communication_preferences = $validatedProfile['communication_preferences'] ?? Null;
    //             $profile->research_interests = $validatedProfile['research_interests'] ?? Null;
    //             $profile->social_integration = $validatedProfile['social_integration'] ?? Null;

    //             $profile->image = $imageName;
    //             // dd($profile);

    //             $profile->save();

    //             // Validate and create guarantor
    //             $validatedGuarantor = $this->validateGuarantor($request);
    //             $this->createGuarantor($validatedGuarantor, $user);

    //             // Check if profile is successfully created
    //             if ($profile) {
    //                 // Both user and profile are successfully created
    //                 // Commit the transaction
    //                 DB::commit();

    //                 // Redirect with success message
    //                 return redirect()->route('users.index')->with('success', 'User and profile created successfully.');
    //             } else {
    //                 // Rollback the transaction in case profile creation fails
    //                 DB::rollback();

    //                 // Redirect back with error message
    //                 return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred here while creating user profile.']);
    //             }
    //         } else {
    //             // Rollback the transaction in case user creation fails
    //             DB::rollback();

    //             // Redirect back with error message
    //             return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred while creating user.']);
    //         }
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         // Validation error
    //         return redirect()->back()->withInput()->withErrors($e->validator->errors());
    //     } catch (\Exception $e) {
    //         // Rollback the transaction in case of an error
    //         DB::rollBack();

    //         // Log the error
    //         Log::error('Error creating user: ' . $e->getMessage());

    //         // Redirect back with error message
    //         return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred while creating user and profile. Please try again.']);
    //     }
    // }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            // Validate the incoming request data
            $validatedUser = $this->validateUser($request);
            $validatedProfile = $this->validateProfile($request);
            $validatedGuarantor = $this->validateGuarantor($request);


            // Use database transactions to ensure data consistency
            DB::beginTransaction();

            // Create the user
            $user = User::create([
                'name' => $validatedUser['fname'] . ' ' . $validatedUser['lname'],
                'email' => $validatedUser['email'],
                'password' => Hash::make($validatedUser['password']),
                'type' => 'local',
                'status' => 'active',
            ]);

            if ($user) {
                // Assign role
                $roleName = $request->input('assign_role');
                $role = Role::firstOrCreate(['name' => $roleName]);
                $user->assignRole($role);

                //   Store the image
                $imageName = null;
                if ($request->hasFile('image')) {

                    $imageName = $this->storeImage($request->file('image'), $request->fname);
                }

                $validatedProfile['image'] = $imageName;

                // Determine the value of member_id based on the provided data
                // $memberId = $request->filled('enrollment_no') ? $request->enrollment_no : $request->employee_id;
                // $validatedProfile['member_id'] = $memberId ?? Null;

                try {
                    // Determine member type from request or default to 'default'
                    // $memberType = $request->input('member_type', 'EX');
                    // $userCount = Profile::where('member_type', $memberType)->count() + 1;
                    // $memberId = 'RNTU-' . strtoupper($memberType[0]) . $userCount;
                    // Generate a random 5-digit number
                    //   $randomDigits = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

                    // Generate the member ID
                    //   $memberId = 'RNTU-' . strtoupper(substr($memberType, 0, 2)) . $randomDigits;
                    // Generate the member ID
                    // $randomAlphaNumeric = $this->generateRandomAlphaNumeric();  

                    $memberType = strtoupper(substr($request->input('member_type', 'EX'), 0, 2)); // Take the first two letters and convert to uppercase
                    $initial = strtoupper(substr($request->input('fname'), 0, 1)); // Take the first letter of the first name and convert to uppercase
                    // $institute = $request->input('institute');
                    $institute = strtoupper(substr($request->input('institute', 'EX'), 0, 4)); // Take the first two letters and convert to uppercase
                    // Generate a unique member ID using the User model method
                    $memberId = User::generateUniqueMemberID($memberType, $initial, $institute);
                } catch (\Exception $e) {
                    // Log the exception
                    Log::error('Error generating member ID: ' . $e->getMessage());

                    // Return a generic error response
                    return response()->json(['message' => 'An error occurred while processing your request. Please try again later.'], 500);
                }
                $validatedProfile['member_id'] = $memberId ?? Null;

                // Create profile
                $profile = $this->updateOrCreateProfile($validatedProfile, $user);
                // $profileData = $validatedProfile;
                // $profileData['user_id'] = $user->id;
                // $profile = Profile::create($profileData);

                // Create or update guarantor

                if ($profile) {
                    // Both user and profile are successfully created
                    $validatedGuarantor = $this->validateGuarantor($request);
                    $guarantor =  $this->createGuarantor($validatedGuarantor, $user);

                    if ($guarantor) {

                        // Commit the transaction
                        DB::commit();

                        // Redirect with success message
                        return redirect()->route('users.index')->with('success', 'User profile created successfully. Your Member ID is: ' . $memberId);

                    } else {
                        // Rollback the transaction in case profile creation fails
                        DB::rollback();

                        // Redirect back with error message
                        return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred here while creating Gurantor Info.']);
                    }
                } else {
                    // Rollback the transaction in case profile creation fails
                    DB::rollback();

                    // Redirect back with error message
                    return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred here while creating user profile.']);
                }
            } else {
                // Rollback the transaction in case user creation fails
                DB::rollback();

                // Redirect back with error message
                return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred while creating user.']);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation error
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors($e->validator->errors());
        } catch (\Illuminate\Database\QueryException $e) {
            // Database query error
            DB::rollBack();
            // Log::error('Database error: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred while processing your request. Please try again.']);
        } catch (\Exception $e) {
            // Other generic error
            DB::rollBack();
            // Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Load the user with their profile
        $user = User::with('profile', 'guarantor')->findOrFail($user->id);

        // Load associated guarantor details
        // $guarantor = $user->guarantor; // Assuming you have a relationship defined in your User model


        // $userData = User::with('profile', 'roles', 'guarantor')->find($user);
        return view('manage.users.show', compact('user'));
    }

    public function printRegistrationForm($id)
    {

        // Load the user with their profile
        $user = User::with('profile')->findOrFail($id);

        return view('manage.users.print_registration', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load('profile');
        $roles = Role::all();
        $academics = AcademicEntity::all();
        // Load associated guarantor details
        $guarantor = $user->guarantor; // Assuming you have a relationship defined in your User model

        // $user = User::with(['roles', 'profile'])->findOrFail($user);
        return view('manage.users.edit', compact('user', 'roles', 'guarantor', 'academics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //  dd($request->all());
        try {
            // Find the course by ID or fail if not found
            $user = User::findOrFail($user->id);
            // Validate the incoming request data
            // $validatedUser = $this->validateUser($request);

            // $validatedUser = $this->validateUser($request, $id);
            $request->validate([
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($user), // Exclude the current user's ID from the uniqueness check
                ],
            ]);


            $validatedProfile = $this->validateProfile($request);

            // Use database transactions to ensure data consistency
            DB::beginTransaction();

            // Find the user by ID
            // $user = User::findOrFail($user->id);

            // Update user details
            $user->name = $request->fname . ' ' . $request->lname;


            // Check if the email is changing
            if ($request->email != $user->email) {
                $user->email = $request->email;
            }

            if ($request->has('change_password')) {
                // Validate password fields
                $request->validate([
                    'password' => 'required|string|min:8|confirmed',
                ]);

                // Update password
                $user->password = Hash::make($request->password);
            }

            $user->save();

            // Update user roles if roles are provided in the request
            if ($request->filled('assign_role')) {
                // Validate the roles provided in the request
                $request->validate([

                    'assign_role.*' => 'exists:roles,name',

                ]);

                // Synchronize user roles
                $user->syncRoles($request->assign_role);
            }

            // Update profile
            $profile = Profile::where('user_id', $user->id)->first();

            if (!$profile) {
                // Create a new profile if it doesn't exist
                $profile = new Profile();
                $profile->user_id = $user->id;
            }

            // Determine the value of member_id based on the provided data
            $memberId = $request->filled('enrollment_no') ? $request->enrollment_no : $request->employee_id;
            $validatedProfile['member_id'] = $memberId;

            $profile->fname = $validatedProfile['fname'];
            $profile->lname = $validatedProfile['lname'];
            $profile->email = $user->email;
            $profile->dob = $validatedProfile['dob'];
            $profile->gender = $validatedProfile['gender'];

            $profile->member_type = $validatedProfile['member_type'];

            $profile->member_id = $validatedProfile['member_id'];

            $profile->year_of_admission = $validatedProfile['year_of_admission'];

            $profile->joining_date = $validatedProfile['joining_date'];

            $profile->category = $validatedProfile['category'];
            $profile->institute = $validatedProfile['institute'];
            $profile->faculty = $validatedProfile['faculty'];
            $profile->department = $validatedProfile['department'];
            $profile->course = $validatedProfile['course'];
            $profile->designation = $validatedProfile['designation'];

            $profile->phone = $validatedProfile['phone'];
            $profile->alternate_email = $validatedProfile['alternate_email'];

            $profile->present_address = $validatedProfile['present_address'];
            $profile->present_city = $validatedProfile['present_city'];
            $profile->present_pincode = $validatedProfile['present_pincode'];
            $profile->permanent_address = $validatedProfile['permanent_address'];
            $profile->permanent_city = $validatedProfile['permanent_city'];
            $profile->permanent_pincode = $validatedProfile['permanent_pincode'];
            $profile->permanent_phone = $validatedProfile['permanent_phone'];


            $profile->preferred_genres = $validatedProfile['preferred_genres'] ?? Null;
            $profile->preferred_language = $validatedProfile['preferred_language'] ?? Null;

            $profile->favorite_resources = $validatedProfile['favorite_resources'] ?? Null;
            $profile->communication_preferences = $validatedProfile['communication_preferences'] ?? Null;
            $profile->research_interests = $validatedProfile['research_interests'] ?? Null;
            $profile->social_integration = $validatedProfile['social_integration'] ?? Null;


            // Store the image if provided or remove it if requested, otherwise keep the existing one
            if ($request->hasFile('image')) {
                // New image is provided, delete the existing one if it exists
                if ($profile->image) {
                    $this->deleteImage($profile->image);
                }

                $imageName = $this->storeImage($request->file('image'), $request->fname);
                $profile->image = $imageName;
            } elseif ($request->has('remove_image')) {
                // Request to remove the image
                if ($profile->image) {
                    $this->deleteImage($profile->image);
                    $profile->image = null; // Set image name to null in the database
                }
            } else {
                // No new image is provided and remove_image is not requested, keep the existing image
                // No action needed
            }

            $profile->save();

            // Validate and update guarantor
            $validatedGuarantor = $this->validateGuarantor($request);
            $this->updateGuarantor($validatedGuarantor, $user);


            // Commit the transaction
            DB::commit();

            // Redirect with success message
            return redirect()->route('users.index')->with('success', 'User and profile updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation error
            return redirect()->back()->withInput()->withErrors($e->validator->errors());
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            // Log the error
            Log::error('Error updating user: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred while updating user and profile. Please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {

            // Delete the user's profile if it exists
            if ($user->profile) {

                if ($user->profile->image) {
                    $this->deleteImage($user->profile->image);
                }
                $user->profile->delete();
            }
            // 

            // Delete the user
            $user->delete();

            // Optionally, you can add a success message
            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            // Handle any exceptions that occur during deletion
            Log::error('Error deleting user: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred while deleting user.']);
        }
    }

    // public function updateStatus(Request $request, User $user)
    // {
    //     $request->validate([
    //         'status' => 'required|in:active,pending_approval,rejected', // Add any additional status options here
    //     ]);

    //     $user->update(['status' => $request->status]);

    //     return redirect()->back()->with('status', 'User status updated successfully.');
    // }

    public function updateStatus(Request $request, User $user)
    {
        try {
            // Validate request data
            $request->validate([
                'status' => 'required|in:active,inactive,pending,suspended,blocked', // Add your validation rules here
            ]);

            // Update user status
            $user->status = $request->status;
            // $user->save();
            $user->update();
            // Return a success response
            return response()->json(['message' => 'User status updated successfully']);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => 'An error occurred while updating user status.'], 500);
        }
    }

    private function validateUser(Request $request, $id = null)
    {
        return $request->validate([
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:users,email|max:255',
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id), // Exclude the current user's ID from the uniqueness check
            ],
            'password' => 'required|string|confirmed|min:8', // Example password validation
        ]);
    }

    // In the validateProfile method
    private function validateProfile(Request $request)
    {
        return $request->validate([
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|email|max:255',
            // 'alternate_email' => 'nullable|email|max:255',
            // 'unic_id' => 'nullable|string|max:255',
            'assign_role' => 'required|string|max:255',


            'fname' => 'required|string|max:255',
            'lname' => 'nullable|string|max:255',
            // 'email' => 'required|email|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:255',

            'member_type' => 'nullable|string|max:255',
            'enrollment_no' => 'nullable|string|max:255', // 'member_id',
            'employee_id' => 'nullable|string|max:255',  //'member_id',

            'year_of_admission' => 'nullable|integer',
            'joining_date' => 'nullable|date',

            'category' => 'nullable|string|max:255',
            'institute' => 'nullable|string|max:255',
            'faculty' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'course' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',

            'enrollment_number' => 'nullable|string|max:255',
            'employee_id' => 'nullable|string|max:255',

            'phone' => 'nullable|string|max:13',
            'alternate_email' => 'nullable|email|max:255',
            'present_address' => 'nullable|string|max:255',
            'present_city' => 'nullable|string|max:255',
            'present_pincode' => 'nullable|string|max:6',
            'permanent_address' => 'nullable|string|max:255',
            'permanent_city' => 'nullable|string|max:255',
            'permanent_pincode' => 'nullable|string|max:6',
            'permanent_phone' => 'nullable|string|max:13',
            'preferred_genres' => 'nullable|string|max:255',
            'preferred_language' => 'nullable|string|max:255',
            'favorite_resources' => 'nullable|string|max:255',
            'communication_preferences' => 'nullable|string|max:255',
            'research_interests' => 'nullable|string|max:255',
            'social_integration' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming image upload with max size of 2MB

        ]);
    }

    protected function createProfile($validatedProfile, $user)
    {
        try {
            $profile = new Profile();
            $profile->user_id =  $user->id;
            $profile->fname = $validatedProfile['fname'];
            $profile->lname = $validatedProfile['lname'];
            $profile->email = $user->email;
            $profile->dob = $validatedProfile['dob'];
            $profile->gender = $validatedProfile['gender'];

            $profile->member_type = $validatedProfile['member_type'];
            $profile->member_id = $validatedProfile['member_id'];
            $profile->year_of_admission = $validatedProfile['year_of_admission'];
            $profile->year_of_joining = $validatedProfile['year_of_joining'];

            $profile->category = $validatedProfile['category'];
            $profile->institute = $validatedProfile['institute'];
            $profile->faculty = $validatedProfile['faculty'];
            $profile->department = $validatedProfile['department'];
            $profile->course = $validatedProfile['course'];
            $profile->designation = $validatedProfile['designation'];

            $profile->enrollment_number = $validatedProfile['enrollment_number'] ?? '';
            $profile->employee_id = $validatedProfile['employee_id'] ?? '';

            $profile->phone = $validatedProfile['phone'];
            $profile->alternate_email = $validatedProfile['alternate_email'];

            $profile->present_address = $validatedProfile['present_address'];
            $profile->present_city = $validatedProfile['present_city'];
            $profile->present_pincode = $validatedProfile['present_pincode'];
            $profile->permanent_address = $validatedProfile['permanent_address'];
            $profile->permanent_city = $validatedProfile['permanent_city'];
            $profile->permanent_pincode = $validatedProfile['permanent_pincode'];
            $profile->permanent_phone = $validatedProfile['permanent_phone'];

            $profile->preferred_genres = $validatedProfile['preferred_genres'] ?? Null;
            $profile->preferred_language = $validatedProfile['preferred_language'] ?? Null;

            $profile->favorite_resources = $validatedProfile['favorite_resources'] ?? Null;
            $profile->communication_preferences = $validatedProfile['communication_preferences'] ?? Null;
            $profile->research_interests = $validatedProfile['research_interests'] ?? Null;
            $profile->social_integration = $validatedProfile['social_integration'] ?? Null;

            $profile->image = $validatedProfile['image'] ?? Null;


            $profile->save();

            return $profile;
        } catch (\Exception $e) {
            // Log::error('Failed to store image: ' . $e->getMessage());
            return null;
        }
    }
    protected function updateOrCreateProfile($validatedProfile, $user)
    {
        try {
            // Check if the user already has a profile
            $profile = $user->profile;

            // If the user does not have a profile, create a new one
            if (!$profile) {
                $profile = new Profile();
                $profile->user_id =  $user->id;
            }

            // Update profile data
            $profile->fname = $validatedProfile['fname'];
            $profile->lname = $validatedProfile['lname'];
            $profile->email = $user->email;
            $profile->dob = $validatedProfile['dob'];
            $profile->gender = $validatedProfile['gender'];

            $profile->member_type = $validatedProfile['member_type'];
            $profile->member_id = $validatedProfile['member_id'];
            $profile->year_of_admission = $validatedProfile['year_of_admission'];
            $profile->joining_date = $validatedProfile['joining_date'];

            $profile->category = $validatedProfile['category'];
            $profile->institute = $validatedProfile['institute'];
            $profile->faculty = $validatedProfile['faculty'];
            $profile->department = $validatedProfile['department'];
            $profile->course = $validatedProfile['course'];
            $profile->designation = $validatedProfile['designation'];

            $profile->enrollment_number = $validatedProfile['enrollment_number'] ?? '';
            $profile->employee_id = $validatedProfile['employee_id'] ?? '';

            $profile->phone = $validatedProfile['phone'];
            $profile->alternate_email = $validatedProfile['alternate_email'];

            $profile->present_address = $validatedProfile['present_address'];
            $profile->present_city = $validatedProfile['present_city'];
            $profile->present_pincode = $validatedProfile['present_pincode'];
            $profile->permanent_address = $validatedProfile['permanent_address'];
            $profile->permanent_city = $validatedProfile['permanent_city'];
            $profile->permanent_pincode = $validatedProfile['permanent_pincode'];
            $profile->permanent_phone = $validatedProfile['permanent_phone'];

            $profile->preferred_genres = $validatedProfile['preferred_genres'] ?? Null;
            $profile->preferred_language = $validatedProfile['preferred_language'] ?? Null;

            $profile->favorite_resources = $validatedProfile['favorite_resources'] ?? Null;
            $profile->communication_preferences = $validatedProfile['communication_preferences'] ?? Null;
            $profile->research_interests = $validatedProfile['research_interests'] ?? Null;
            $profile->social_integration = $validatedProfile['social_integration'] ?? Null;

            $profile->image = $validatedProfile['image'] ?? Null;

            $profile->save();

            return $profile;
        } catch (\Exception $e) {
            // Log error if any
            Log::error('Failed to create or update profile: ' . $e->getMessage());
            return null;
        }
    }

    private function storeImage($image, $name)
    {
        try {
            $imageName = Str::slug($name) . '_' . now()->format('YmdHis') . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('users', $imageName, 'public');
            // Generate and store thumbnail
            $thumbnailPath = $this->generateAndStoreThumbnail($image, $imageName);
            // Log::info('Image stored successfully: ' . $imagePath);
            return $imageName;
        } catch (\Exception $e) {
            // Log::error('Failed to store image: ' . $e->getMessage());
            return null;
        }
    }

    // Helper method to delete an image
    private function deleteImage($imagePath)
    {
        try {
            // Check if the image exists before attempting deletion
            if (Storage::disk('public')->exists('users/' . $imagePath)) {
                // Attempt to delete the image
                Storage::disk('public')->delete('users/' . $imagePath);
                // Log::info('Original image deleted successfully: ' . $imagePath);
            } else {
                // Log::warning('Original image does not exist: ' . $imagePath);
            }

            // Check if the thumbnail exists before attempting deletion
            $thumbnailPath = 'users/thumbnails/' . $imagePath;
            if (Storage::disk('public')->exists($thumbnailPath)) {
                // Attempt to delete the thumbnail
                Storage::disk('public')->delete($thumbnailPath);
                // Log::info('Thumbnail image deleted successfully: ' . $thumbnailPath);
            } else {
                // Log::warning('Thumbnail image does not exist: ' . $thumbnailPath);
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
                })
                ->encode();

            $thumbnailName = $imageName;
            $thumbnailPath = 'public/users/thumbnails/' . $thumbnailName;
            Storage::put($thumbnailPath, $thumbnail);

            return $thumbnailPath;
        } catch (\Exception $e) {
            Log::error('Error storing thumbnail: ' . $e->getMessage());
            throw $e;
        }
    }


    protected function validateGuarantor(Request $request)
    {
        return $request->validate([
            'gr_fname' => 'nullable|string|max:255',
            'gr_lname' => 'nullable|string|max:255',
            'form_number' => 'nullable|string|max:255',
            'library_member' => 'nullable|string|max:255',
            'gr_phone' => 'nullable|string|max:255',
            'gr_email' => 'nullable|string|email|max:255',
            'gr_address' => 'nullable|string|max:255',
            'gr_city' => 'nullable|string|max:255',
            'gr_pincode' => 'nullable|string|max:255',
        ]);
    }

    protected function createGuarantor($validatedGuarantor, $user)
    {
        try {
            $guarantor = new Guarantor();
            $guarantor->user_id = $user->id;
            $guarantor->gr_fname = $validatedGuarantor['gr_fname'];
            $guarantor->gr_lname = $validatedGuarantor['gr_lname'];
            $guarantor->form_number = $validatedGuarantor['form_number'] ?? null;
            $guarantor->library_member = $validatedGuarantor['library_member'] ?? null;
            $guarantor->gr_phone = $validatedGuarantor['gr_phone'] ?? null;
            $guarantor->gr_email = $validatedGuarantor['gr_email'] ?? null;
            $guarantor->gr_address = $validatedGuarantor['gr_address'] ?? null;
            $guarantor->gr_city = $validatedGuarantor['gr_city'] ?? null;
            $guarantor->gr_pincode = $validatedGuarantor['gr_pincode'] ?? null;

            $guarantor->save();

            return $guarantor;
        } catch (\Exception $e) {
            // Log::error('Failed to store guarantor: ' . $e->getMessage());
            return null;
        }
    }

    protected function updateGuarantor($validatedGuarantor, $user)
    {
        // Retrieve the existing guarantor associated with the user
        $guarantor = $user->guarantor;

        // Check if the user has a guarantor
        if ($guarantor) {
            try {
                // Update the guarantor attributes
                $guarantor->update([
                    'gr_fname' => $validatedGuarantor['gr_fname'],
                    'gr_lname' => $validatedGuarantor['gr_lname'],
                    'form_number' => $validatedGuarantor['form_number'],
                    'library_member' => $validatedGuarantor['library_member'],
                    'gr_phone' => $validatedGuarantor['gr_phone'],
                    'gr_email' => $validatedGuarantor['gr_email'],
                    'gr_address' => $validatedGuarantor['gr_address'],
                    'gr_city' => $validatedGuarantor['gr_city'],
                    'gr_pincode' => $validatedGuarantor['gr_pincode'],
                ]);
                return $guarantor;
            } catch (\Exception $e) {
                // Log::error('Failed to create gurantor: ' . $e->getMessage());
                return null;
            }
        } else {
            // If the user does not have a guarantor, create a new one
            $this->createGuarantor($validatedGuarantor, $user);
        }
    }

    // private function generateRandomAlphaNumeric()
    // {
    //     $alpha = range('A', 'Z');
    //     $numeric = range(0, 9);
    //     $characters = array_merge($alpha, $numeric);

    //     $randomAlphaNumeric = '';
    //     for ($i = 0; $i < 6; $i++) {
    //         $randomAlphaNumeric .= $characters[array_rand($characters)];
    //     }

    //     // Ensure only two consecutive characters are alphabetic
    //     $randomAlphaNumeric = preg_replace('/[A-Z]{3,}/', $alpha[rand(0, 25)] . $alpha[rand(0, 25)], $randomAlphaNumeric);

    //     return $randomAlphaNumeric;
    // }

    private function generateRandomAlphaNumeric()
    {
        $alpha = range('A', 'Z');
        $numeric = range(0, 9);
        $characters = array_merge($alpha, $numeric);

        $randomAlphaNumeric = '';
        for ($i = 0; $i < 5; $i++) {
            $randomAlphaNumeric .= $characters[array_rand($characters)];
        }

        // Ensure only one alphabetic character at the end
        $randomAlphaNumeric .= $alpha[array_rand($alpha)];

        return $randomAlphaNumeric;
    }
}
