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
        return view('manage.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            // Validate the incoming request data
            $validatedUser = $this->validateUser($request);
            $validatedProfile = $this->validateProfile($request);

           // $validatedGuarantor = $this->validateGurantor($request); // Validate guarantor data
            // Use database transactions to ensure data consistency
            DB::beginTransaction();

            // Create the user
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password); // Hash the password
            $user->type = 'local';
            $user->status = 'active';

            $user->save();

            // Assign role
            $roleName = $request->input('assign_role'); // Assuming 'role' is the input field name
            $role = Role::firstOrCreate(['name' => $roleName]);

            // Assign the role to the user
            $user->assignRole($role);

            // // Check if user is successfully created
            if ($user) {
                // dd($user);
                // Store the image
                $imageName = null;
                if ($request->hasFile('image')) {

                    $imageName = $this->storeImage($request->file('image'), $request->name);
                }

                //  dd($imageName);
                $profile = new Profile();
                $profile->user_id = $user->id;
                $profile->name = $user->name;
                $profile->email = $user->email;
                $profile->role_position = $validatedProfile['role_position'];
                $profile->faculty = $validatedProfile['faculty'];
                $profile->department = $validatedProfile['department'];
                $profile->phone_number = $validatedProfile['phone_number'];
                $profile->alternate_email = $validatedProfile['alternate_email'];
                $profile->residential_address = $validatedProfile['residential_address'];
                $profile->preferred_genres = $validatedProfile['preferred_genres'];
                $profile->preferred_language = $validatedProfile['preferred_language'];
                $profile->favorite_resources = $validatedProfile['favorite_resources'];
                $profile->library_privileges = $validatedProfile['library_privileges'];
                $profile->access_levels = $validatedProfile['access_levels'];
                $profile->communication_preferences = $validatedProfile['communication_preferences'];
                // $profile->two_factor_authentication = $validatedProfile['two_factor_authentication'];
                // $profile->password_expiry = $validatedProfile['password_expiry'];
                $profile->research_interests = $validatedProfile['research_interests'];
                $profile->social_integration = $validatedProfile['social_integration'];
                $profile->image = $imageName;
                // dd($profile);

                $profile->save();

                 // Validate and create guarantor
        $validatedGuarantor = $this->validateGuarantor($request);
        $this->createGuarantor($validatedGuarantor, $user);

                // Check if profile is successfully created
                if ($profile) {
                    // Both user and profile are successfully created
                    // Commit the transaction
                    DB::commit();

                    // Redirect with success message
                    return redirect()->route('users.index')->with('success', 'User and profile created successfully.');
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
            return redirect()->back()->withInput()->withErrors($e->validator->errors());
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            // Log the error
            Log::error('Error creating user: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->withInput()->withErrors(['error' => 'Error occurred while creating user and profile. Please try again.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load('profile');
        $roles = Role::all();
        // $user = User::with(['roles', 'profile'])->findOrFail($user);
        return view('manage.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        try {
            // Validate the incoming request data
            // $validatedUser = $this->validateUser($request, $id);
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($id), // Exclude the current user's ID from the uniqueness check
                ],
            ]);

            $validatedProfile = $this->validateProfile($request);

            // Use database transactions to ensure data consistency
            DB::beginTransaction();

            // Find the user by ID
            $user = User::findOrFail($id);

            // Update user details
            $user->name = $request->name;

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
            // Update profile details
            $profile->name = $user->name;
            $profile->email = $user->email;
            $profile->role_position = $validatedProfile['role_position'];
            $profile->faculty = $validatedProfile['faculty'];
            $profile->department = $validatedProfile['department'];
            $profile->phone_number = $validatedProfile['phone_number'];
            $profile->alternate_email = $validatedProfile['alternate_email'];
            $profile->residential_address = $validatedProfile['residential_address'];
            $profile->preferred_genres = $validatedProfile['preferred_genres'];
            $profile->preferred_language = $validatedProfile['preferred_language'];
            $profile->favorite_resources = $validatedProfile['favorite_resources'];
            $profile->library_privileges = $validatedProfile['library_privileges'];
            $profile->access_levels = $validatedProfile['access_levels'];
            $profile->communication_preferences = $validatedProfile['communication_preferences'];
            // $profile->two_factor_authentication = $validatedProfile['two_factor_authentication'];
            // $profile->password_expiry = $validatedProfile['password_expiry'];
            $profile->research_interests = $validatedProfile['research_interests'];
            $profile->social_integration = $validatedProfile['social_integration'];

            // Store the image if provided or remove it if requested, otherwise keep the existing one
            if ($request->hasFile('image')) {
                // New image is provided, delete the existing one if it exists
                if ($profile->image) {
                    $this->deleteImage($profile->image);
                }

                $imageName = $this->storeImage($request->file('image'), $request->name);
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
                'status' => 'required|in:active,inactive,pending_approval,suspended,blocked', // Add your validation rules here
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
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:users,email|max:255',
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

            'access_levels' => 'nullable|string|max:255',

            'role_position' => 'nullable|string|max:255',

            'faculty' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'alternate_email' => 'nullable|string|email|max:255',
            'residential_address' => 'nullable|string|max:255',
            'preferred_genres' => 'nullable|string|max:255',
            'preferred_language' => 'nullable|string|max:255',
            'favorite_resources' => 'nullable|string|max:255',
            'library_privileges' => 'nullable|string|max:255',
            'communication_preferences' => 'nullable|string|max:255',
            // 'two_factor_authentication' => 'nullable|boolean',
            // 'password_expiry' => 'nullable|date',
            'research_interests' => 'nullable|string|max:255',
            'social_integration' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
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
            Log::error('Failed to store image: ' . $e->getMessage());
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
            'gr_fname' => 'required|string|max:255',
            'gr_lname' => 'required|string|max:255',
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
        $guarantor = new Guarantor();
        $guarantor->user_id = $user->id;
        $guarantor->gr_fname = $validatedGuarantor['gr_fname'];
        $guarantor->gr_lname = $validatedGuarantor['gr_lname'];
        $guarantor->form_number = $validatedGuarantor['form_number'];
        $guarantor->library_member = $validatedGuarantor['library_member'];
        $guarantor->gr_phone = $validatedGuarantor['gr_phone'];
        $guarantor->gr_email = $validatedGuarantor['gr_email'];
        $guarantor->gr_address = $validatedGuarantor['gr_address'];
        $guarantor->gr_city = $validatedGuarantor['gr_city'];
        $guarantor->gr_pincode = $validatedGuarantor['gr_pincode'];

        $guarantor->save();
    }
}
