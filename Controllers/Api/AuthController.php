<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Middleware\UserActivityMiddleware;

class AuthController extends Controller
{
    //

    public function refreshToken()
    {
        try {
            $token = Session::get('token');

            $response = Http::post('http://127.0.0.1:8002/api/auth/refresh', [
                'token' => $token,
            ]);

            $data = $response->json();
            // dd($data);

            $userRole = 'student'; // Set the user role based on your context

            if (isset($data['access_token'])) {
                // Refresh successful, update the session with the new token
                Session::put('token', $data['access_token']);
                Session::put('user', $data['user']);

                Session::put('userRole', $userRole); // Store the user role in the session

                return redirect()->route("{$userRole}.dashboard")->with('success', 'Token refreshed');
            } else {
                // Refresh failed, log the error and handle accordingly
                return redirect('/login')->with('error', 'Token refresh failed');
            }
        } catch (\Exception $e) {
            // Exception occurred, log the error and handle accordingly
            return redirect('/login')->with('error', 'Token refresh failed. Please try again.');
        }
    }

    public function login(Request $request)
    {
        try {
            // Check if the user is already authenticated
            if (Session::has('token') && Session::has('user')) {
                return redirect('/dashboard')->with('info', 'You are already logged in.');
            }

            $response = Http::post('http://127.0.0.1:8002/api/auth/login', [
                'email' => $request->email,
                'password' => $request->password,
            ]);

            $data = $response->json();

            if (isset($data['access_token'])) {
                // Login successful

                // Check if the user exists locally
                $user = User::where('email', $data['user']['email'])->first();

                if (!$user) {
                    // Create the user locally with a null password
                    $user = User::create([
                        'name' => $data['user']['name'],
                        'email' => $data['user']['email'],
                        'password' => null, // Set password to null
                    ]);

                    // Assign the 'student' role to the user
                    $user->assignRole('student');
                }

                // Store user data in the session
                Session::put('token', $data['access_token']);
                Session::put('user', $user->toArray());

                // Generate a new session ID
                Session::regenerate();

                // Redirect to the intended URL after login
                return redirect('/dashboard')->with('success', 'Login successful');
            } else {
                // Login failed
                return redirect('/login')->with('error', 'Invalid credentials. Please try again.');
            }
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return redirect('/login')->with('error', 'An error occurred during the login process. Please try again later.');
        } catch (\Exception $exception) {
            return redirect('/login')->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }

    public function register(Request $request)
    {
        // // Handle the case where the response is not a valid JSON or does not contain the expected structure
        // return redirect('/register')->with('error', 'Registration failed');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }

        $response = Http::post('http://127.0.0.1:8002/api/auth/register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);

        try {
            $data = $response->json();

            if (isset($data['access_token']) || isset($data['user']) || isset($data['message'])) {
                // Check for success message
                return redirect('/login')->with('success', $data['message']);
            } elseif (isset($data['error'])) {
                // Registration failed with a specific error message
                return redirect('/register')->with('error', $data['error']);
            } else {
                // Unexpected response format
                return redirect('/register')->with('error', 'Registration failed. Unexpected response format.');
            }
        } catch (\Exception $e) {
            // Handle JSON decoding errors or other exceptions
            return redirect('/register')->with('error', 'Registration failed. Please try again later.');
        }
    }

    public function logout()
    {
        // Get the token from the session
        $token = Session::get('token');

        if ($token) {
            try {
                // Perform the logout API request
                $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->post('http://127.0.0.1:8002/api/auth/logout');
            } catch (\Exception $e) {
                // Log the exception for debugging
                logger('API Logout Exception: ' . $e->getMessage());
                // You can also throw or handle the exception here if needed
                // throw $e;
            }

            // Retrieve user data from the session
            $userData = Session::get('user');

            // Clear user data and token from the session upon logout
            Session::forget('token');
            Session::forget('user');
            Session::forget('userRole');

            // Record logout activity
            app(UserActivityMiddleware::class)->recordLogoutActivity($userData, Session::getId());

            // Check if the request was successful (HTTP status code 2xx)
            if ($response->successful()) {
                return redirect('/login')->with('success', $response->json()['message']);
            } else {
                // Handle the case where the API request was not successful
                return redirect('/login')->with('error', 'Logout failed. API request error.');
            }
        }

        // Handle the case where the token is not present
        return redirect('/login')->with('error', 'Logout failed. Token not present.');
    }


    // public function handleIntendedUrl(Request $request)
    // {
    //     $intendedUrl = $request->session()->pull('url.intended', '/dashboard'); // Set the default URL to the dashboard view
    //     return Redirect::to($intendedUrl); // Redirect to the intended URL
    // }
}
