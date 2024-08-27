<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Profile;
use Illuminate\View\View;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Validation\ValidationException;
use App\Http\Middleware\UserActivityMiddleware;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    // public function create(): View
    // {
    //     return view('auth.login');
    // }

    // /**
    //  * Handle an incoming authentication request.
    //  */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(RouteServiceProvider::HOME);
    // }

    /**
     * Destroy an authenticated session.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     Auth::guard('web')->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return redirect('/');
    // }




    public function create(): View
    {
        // echo "view";
        return view('auth.login');
    }

    // Complete code in single Shot
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     try {
    //         // Check if the user is already authenticated
    //         if (Auth::check()) {
    //             return redirect('/dashboard')->with('info', 'You are already logged in.');
    //         }

    //         // Attempt local authentication
    //         $attempted = Auth::attempt($request->only('email', 'password'));

    //         // Check if local user not found or has 'student' role
    //         if (!$attempted || Auth::user()->hasRole('student')) {
    //             // Send request to remote service for authentication
    //             $response = Http::post('http://127.0.0.1:8002/api/auth/login', [
    //                 'email' => $request->email,
    //                 'password' => $request->password,
    //             ]);

    //             $data = $response->json();

    //             if (isset($data['access_token']) && isset($data['user']['id'])) {
    //                 // Remote Authentication Successful

    //                 // Check if the user exists locally
    //                 $localUser = User::where('email', $data['user']['email'])->first();

    //                 if (!$localUser) {
    //                     // User not found locally, create
    //                     $localUser = User::create([
    //                         'name' => $data['user']['name'] ?? 'Unknown',
    //                         'email' => $data['user']['email'],
    //                         'password' => Hash::make($request->password),
    //                     ]);

    //                     // Assign the 'student' role to the user on first-time remote authentication
    //                     $localUser->assignRole('student');
    //                 } else {
    //                     // User found locally, update user details if necessary
    //                     $localUser->update([
    //                         'name' => $data['user']['name'] ?? $localUser->name,
    //                         'email' => $data['user']['email'] ?? $localUser->email,
    //                         // Add other fields to update if needed
    //                     ]);
    //                 }

    //                 // Create or update member profile
    //                 $profile = Profile::updateOrCreate(
    //                     ['user_id' => $localUser->id],
    //                     [
    //                         'name' => $localUser->name,
    //                         'email' => $localUser->email,
    //                         'role_position' => 'student', // Set as needed
    //                         'unic_id' => $data['user']['id'],
    //                         // Add other fields to update if needed
    //                     ]
    //                 );

    //                 //  dd($profile);

    //                 // Log in the user
    //                 Auth::login($localUser);

    //                 // Store user data in the session
    //                 Session::put('token', $data['access_token']);
    //                 Session::put('user', $localUser->toArray());

    //                 // Additional
    //                 Session::put('profile', $profile->toArray());

    //                 // Generate a new session ID
    //                 Session::regenerate();

    //                 // Redirect to the intended URL after login
    //                 return redirect('/dashboard')->with('success', 'Login successful');
    //             } else {
    //                 // Remote Authentication Failed or missing required data
    //                 throw ValidationException::withMessages(['email' => ['Invalid credentials. Please try again.']]);
    //             }
    //         }

    //         // Local Authentication Successful without 'student' role
    //         // Redirect to the intended URL after login
    //         return redirect('/dashboard')->with('success', 'Login successful');
    //     } catch (\Illuminate\Http\Client\RequestException $exception) {
    //         return redirect('/login')->with('error', 'An error occurred during the login process. Please try again later.');
    //     } catch (\Exception $exception) {
    //         return redirect('/login')->with('error', 'An unexpected error occurred. Please try again later.');
    //     }
    // }

    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     try {
    //         // Check if the user is already authenticated
    //         if (Auth::check()) {
    //             return redirect('/dashboard')->with('info', 'You are already logged in.');
    //         }

    //         // Attempt local authentication
    //         $localUser = $this->attemptLocalAuthentication($request);
    //         // dd($localUser, Auth::user()->type);
    //         // Check if local user not found or has 'student' role
    //         // if (!$localUser || Auth::user()->hasRole('student')) {
    //         if (!$localUser || Auth::user()->type === 'remote') {
    //             // Attempt remote authentication
    //             $data = $this->attemptRemoteAuthentication($request);
    //             dd($data);
    //             // Check if the 'access_token' key exists in the response
    //             if (isset($data['access_token']) && isset($data['user']['id'])) {
    //                 // Remote Authentication Successful

    //                 // Check if the user exists locally
    //                 $localUser = $this->getOrCreateLocalUser($data);

    //                 // Create or update member profile
    //                 $profile = $this->createOrUpdateProfile($localUser, $data);

    //                 // dd($localUser->getRoleNames());
    //                 // Log in the user
    //                 Auth::login($localUser);

    //                 // Store user data in the session
    //                 Session::put('token', $data['access_token']);
    //                 Session::put('user', $localUser->toArray());
    //                 // $unicid = $data['user']['id'];
    //                 Session::put('unic_id', $data['user']['id']);
    //                 Session::put('profile', $profile->toArray());

    //                 // Generate a new session ID
    //                 Session::regenerate();

    //                 // Log login activity
    //                 app(UserActivityMiddleware::class)->logLoginActivity(Auth::user());
    //                 // $this->logLoginActivity(Auth::user());

    //                 // Redirect to the intended URL after login
    //                 return redirect('/dashboard')->with('success', 'Login successful');
    //             } else {
    //                 // Remote Authentication Failed or missing required data
    //                 if (isset($data['error']) && $data['error'] === 'unauthorized') {
    //                     // Handle unauthorized response from the API
    //                     // For example, redirect back to login with an error message
    //                     return redirect()->back()->withInput()->withErrors(['email' => 'Unauthorized. Please check your credentials.']);
    //                 } else {
    //                     // Handle other errors or missing data
    //                     throw ValidationException::withMessages(['email' => ['Invalid credentials. Please try again.']]);
    //                 }
    //             }
    //         }

    //         // Local Authentication Successful without 'student' role
    //         // Redirect to the intended URL after login
    //         return redirect('/dashboard')->with('success', 'Login successful');
    //     } catch (\Illuminate\Http\Client\RequestException $exception) {
    //         return redirect('/login')->with('error', 'An error occurred during the login process. Please try again later.');
    //     } catch (\Exception $exception) {
    //         return redirect('/login')->with('error', 'An unexpected error occurred. Please try again later.');
    //     }
    // }


    // Worth
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     try {
    //         // Check if the user is already authenticated
    //         if (Auth::check()) {
    //             return redirect('/dashboard')->with('info', 'You are already logged in.');
    //         }

    //         // Attempt local authentication
    //         $credentials = $request->only('email', 'password');

    //         // Attempt local authentication
    //         if (Auth::attempt($credentials)) {
    //             // Local authentication succeeded
    //             $localUser = Auth::user();

    //             // If the user is found locally but their type is "remote", attempt remote authentication
    //             if ($localUser->type === 'remote') {
    //                 $data = $this->attemptRemoteAuthentication($request);

    //                 // Check if remote authentication successful
    //                 if (isset($data['access_token']) && isset($data['user']['id'])) {
    //                     // Remote Authentication Successful

    //                     // Log in the user
    //                     Auth::login($localUser);

    //                     // Store user data in the session
    //                     Session::put('token', $data['access_token']);
    //                     Session::put('user', $localUser->toArray());
    //                     Session::put('unic_id', $data['user']['id']);
    //                     Session::put('profile', $this->createOrUpdateProfile($localUser, $data)->toArray());

    //                     // Generate a new session ID
    //                     Session::regenerate();

    //                     // Log login activity
    //                     app(UserActivityMiddleware::class)->logLoginActivity(Auth::user());

    //                     // Redirect to the dashboard after login
    //                     return redirect('/dashboard')->with('success', 'Login successful');
    //                 } else {
    //                     // Remote Authentication Failed or missing required data
    //                     throw new \Exception('Remote authentication failed or missing data');
    //                 }
    //             } else {
    //                 // Local authentication succeeded and user type is not "remote"
    //                 // Log in the user
    //                 Auth::login($localUser);

    //                 // Redirect to the dashboard after login
    //                 return redirect('/dashboard')->with('success', 'Login successful');
    //             }
    //         } else {
    //             // Local authentication failed
    //             // Check if the user exists with the provided email
    //             $user = User::where('email', $credentials['email'])->first();

    //             if ($user) {
    //                 // User found locally, but invalid credentials
    //                 throw ValidationException::withMessages(['email' => ['Invalid credentials. Please try again.']]);
    //             } else {
    //                 // User does not exist locally, attempt remote authentication
    //                 $data = $this->attemptRemoteAuthentication($request);

    //                 // Check if remote authentication successful
    //                 if (isset($data['access_token']) && isset($data['user']['id'])) {
    //                     // Remote Authentication Successful

    //                     // Check if the user exists locally
    //                     $localUser = $this->getOrCreateLocalUser($data);

    //                     // Log in the user
    //                     Auth::login($localUser);

    //                     // Store user data in the session
    //                     Session::put('token', $data['access_token']);
    //                     Session::put('user', $localUser->toArray());
    //                     Session::put('unic_id', $data['user']['id']);
    //                     Session::put('profile', $this->createOrUpdateProfile($localUser, $data)->toArray());

    //                     // Generate a new session ID
    //                     Session::regenerate();

    //                     // Log login activity
    //                     app(UserActivityMiddleware::class)->logLoginActivity(Auth::user());

    //                     // Redirect to the dashboard after login
    //                     return redirect('/dashboard')->with('success', 'Login successful');
    //                 } else {
    //                     // Remote Authentication Failed or missing required data
    //                     throw new \Exception('Remote authentication failed or missing data');
    //                 }
    //             }
    //         }
    //     } catch (RequestException $exception) {
    //         // Handle HTTP request errors
    //         return redirect('/login')->with('error', 'An error occurred during the login process. Please try again later.');
    //     } catch (\Exception $exception) {
    //         // Handle unexpected errors
    //         return redirect('/login')->with('error', $exception->getMessage());
    //     }
    // }

    public function store(LoginRequest $request): RedirectResponse
    {

        try {
            // Check if the user is already authenticated
            if (Auth::check()) {
                return redirect('/dashboard')->with('info', 'You are already logged in.');
            }

            // Attempt local authentication
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                // Local authentication succeeded
                $localUser = Auth::user();

                // If the user is found locally but their type is "remote", attempt remote authentication
                if ($localUser->type === 'remote') {
                    return $this->handleRemoteAuthentication($request, $localUser);
                }

                // Log in the user
                Auth::login($localUser);

                // Log login activity
                app(UserActivityMiddleware::class)->logLoginActivity(Auth::user());

                // Redirect to the dashboard after login
                return redirect('/dashboard')->with('success', 'Login successful');
            }

            // Local authentication failed
            $user = User::where('email', $credentials['email'])->first();

            if ($user) {
                // User found locally, but invalid credentials
                // throw ValidationException::withMessages(['email' => ['Invalid credentials. Please try again.']]);
                throw ValidationException::withMessages(['email' => ['The email or password is incorrect. Please try again.']]);
            }

            // Attempt remote authentication
            return $this->handleRemoteAuthentication($request);
        } catch (QueryException $exception) {
            // Handle database query exceptions
            // return redirect('/login')->with('error', 'A database error occurred. Please try again later.');
            return redirect()->back()->with('error', 'A database error occurred. Please try again later.');
        } catch (RequestException $exception) {
            // Handle HTTP request errors
            return redirect()->back()->with('error', 'An error occurred during the login process. Please try again later.');
        } catch (\PDOException $exception) {
            // Handle PDO exceptions (database connection errors)
            return redirect()->back()->with('error', 'A database connection error occurred. Please try again later.');
        } catch (\Exception $exception) {
            // Handle unexpected errors
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    private function handleRemoteAuthentication(LoginRequest $request, $localUser = null): RedirectResponse
    {
        try {
            $response = Http::post('http://127.0.0.1:8002/api/auth/login', [
                'email' => $request->email,
                'password' => $request->password,
            ]);

            // Check if the request was successful
            $response->throw();

            // Return the JSON response
            $data = $response->json();

            // Check if user exists locally, otherwise create
            if (!$localUser) {
                $localUser = $this->getOrCreateLocalUser($data);
            }

            // Log in the user
            Auth::login($localUser);

            // Store user data in the session
            Session::put('token', $data['access_token']);
            Session::put('user', $localUser->toArray());
            Session::put('unic_id', $data['user']['id']);
            Session::put('profile', $this->createOrUpdateProfile($localUser, $data)->toArray());

            // Generate a new session ID
            Session::regenerate();

            // Log login activity
            app(UserActivityMiddleware::class)->logLoginActivity(Auth::user());

            // Redirect to the dashboard after login
            return redirect('/dashboard')->with('success', 'Login successful');
        } catch (RequestException $exception) {
            // Handle request exceptions
            throw new \Exception('Login failed. Please check your credentials and try again.');
        } catch (QueryException $exception) {
            // Handle database query exceptions
            // return redirect('/login')->with('error', 'A database error occurred. Please try again later.');
            return redirect()->back()->with('error', 'A database error occurred. Please try again later.');
        } catch (\Exception $exception) {
            // Catch any other exceptions
            return redirect()->back()->with('error', 'An error occurred while attempting to authenticate. Please try again later.');
        }
    }


    private function attemptLocalAuthentication(LoginRequest $request)
    {
        // Attempt local authentication
        if (Auth::attempt($request->only('email', 'password'))) {
            // Authentication successful, return the authenticated user
            return Auth::user();
        } else {
            // Authentication failed, return null
            return null;
        }
    }

    // private function attemptLocalAuthentication(LoginRequest $request)
    // {
    //     return Auth::attempt($request->only('email', 'password'));
    // }

    // private function attemptRemoteAuthentication(LoginRequest $request)
    // {
    //     // return Http::post('http://127.0.0.1:8002/api/auth/login', [
    //     //     'email' => $request->email,
    //     //     'password' => $request->password,
    //     // ])->json();

    //     try {
    //         $response = Http::post('http://127.0.0.1:8002/api/auth/login', [
    //             'email' => $request->email,
    //             'password' => $request->password,
    //         ]);

    //         // Check the HTTP status code
    //         if ($response->successful()) {
    //             return $response->json();
    //         } else {
    //             // dd($response->json());
    //             // Log the unsuccessful response
    //             // \Illuminate\Support\Facades\Log::error('Remote authentication failed. HTTP status code: ' . $response->status());
    //             throw new \Exception('Remote authentication failed. HTTP status code: ' . $response->status());
    //         }
    //     } catch (\Illuminate\Http\Client\RequestException $exception) {
    //         // Log or handle the exception as needed
    //         //  \Illuminate\Support\Facades\Log::error('Request exception during remote authentication', ['exception' => $exception]);
    //         throw new \Exception('Remote authentication failed');
    //     }
    // }


    private function getOrCreateLocalUser(array $data)
    {
        // Check if the user exists locally
        $localUser = User::where('email', $data['user']['email'])->first();

        if (!$localUser) {
            // User not found locally, create
            $localUser = User::create([
                'name' => $data['user']['name'] ?? 'Unknown',
                'email' => $data['user']['email'],
                'password' => Hash::make(request('password')),
                'type' => 'remote', // Set user type as remote
                'status' => 'active' // Set user status as active
                // 'password' => Hash::make(Str::random()), // Set a random password
            ]);

            // Assign the 'student' role to the user on first-time remote authentication
            $localUser->assignRole('student');
        } else {
            // User found locally, update user details if necessary
            $localUser->update([
                'name' => $data['user']['name'] ?? $localUser->name,
                'email' => $data['user']['email'] ?? $localUser->email,
                // Add other fields to update if needed
            ]);
        }

        return $localUser;
    }

    private function createOrUpdateProfile(User $localUser, array $data)
    {
        $fullName = $localUser->name;
        $nameParts = explode(' ', $fullName); // Split by space

        // // Determine last name
        if (count($nameParts) > 1) {
            $lastName = array_pop($nameParts);
        } else {
            // If there's only one part, consider it as the first name and set last name to empty string
            $lastName = '';
        }

        // Determine first name
        $firstName = implode(' ', $nameParts); // Join the remaining parts for the first name

        // Determine last name

        return Profile::updateOrCreate(
            ['user_id' => $localUser->id],
            [
                // 'name' => $localUser->name,
                //

                //
                'fname' => $firstName,
                'lname' => $lastName,

                'email' => $localUser->email,
                // 'role_position' => 'student', // Set as needed
                'member_type' => $data['role'] ?? $data['position'] ?? 'student',
                'unic_id' => $data['unic_id'] ?? $data['enrollment_no'] ?? $data['user']['id'],
                // Add other fields to update if needed
            ]
        );
    }


    public function destroy(Request $request): RedirectResponse
    {

        // Get the authenticated user
        $user = Auth::user();

        // Log logout activity with local user id
        app(UserActivityMiddleware::class)->logLogoutActivity($user);

        // Perform the logout logic
        Auth::guard('web')->logout();

        // $this->logLogoutActivity($localUserId);
        // Call the logLogoutActivity method from your middleware
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // protected function logLoginActivity($user)
    // {
    //     UserActivity::create([
    //         'local_user_id' => $user->id,
    //         'unic_id' => Session::get('unic_id'),
    //         'page_name' => 'login',
    //         'url' => '',
    //         'start_time' => now(),
    //         'end_time' => now(), // Initialize end_time with the current time
    //         'time_spent' => 0,
    //         'session_id' => Session::getId(),
    //     ]);
    // }

    // protected function logLogoutActivity($localUserId)
    // {
    //     $lastActivity = UserActivity::where('session_id', Session::getId())
    //         ->where('page_name', '<>', 'logout') // Exclude 'logout' page
    //         ->latest('id')
    //         ->first();

    //     if ($lastActivity) {
    //         $lastActivity->update([
    //             'end_time' => now(),
    //             'time_spent' => $this->calculateTimeSpent($lastActivity->start_time, now()),
    //         ]);
    //     }

    //     // Create a new record for logout activity
    //     UserActivity::create([
    //     'local_user_id' => $localUserId,
    //      'unic_id' => Session::get('unic_id'),
    //         'page_name' => 'logout',
    //         'url' => '',
    //         'start_time' => now(),
    //         'end_time' => now(), // Initialize end_time with the current time
    //         'time_spent' => 0,
    //         'session_id' => Session::getId(),
    //     ]);
    // }

    // protected function calculateTimeSpent($startTime, $endTime)
    // {
    //     // Calculate time spent in seconds
    //     return $endTime->diffInSeconds($startTime);
    // }  
}
