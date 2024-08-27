<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
// Import the correct User model
// use App\Models\User;

class UserActivityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }

    // 13 feb
    // public function handle($request, Closure $next)
    // {
    //     $response = $next($request);

    //     // Check if the user is authenticated
    //     if (Auth::check()) {
    //         $userData = Auth::user();
    //         $currentPage = $request->route()->getName();
    //         $currentUrl = $request->url();
    //         $sessionId = $request->session()->getId();

    //         // Exclude roles that you don't want to track (e.g., 'admin', 'manager')
    //         $excludedRoles = ['admin', 'manager'];
    //         //dd($userData->roles->first()->name);
    //         // Check if the user role is excluded
    //         // if (!in_array($userData->getRoleNames()->first(), $excludedRoles)) {
    //         // if (!$userData->hasAnyRole($excludedRoles)) {
    //         if (!in_array($userData->roles->first()->name, $excludedRoles)) {
    //             $lastActivity = UserActivity::where('local_user_id', $userData->id)
    //                 ->where('session_id', $sessionId)
    //                 ->where('page_name', '<>', 'login') // Exclude 'login' page
    //                 ->latest('id')
    //                 ->first();

    //             // Update end_time for the last activity if the user moved to a new page (excluding 'login')
    //             if ($lastActivity && $lastActivity->page_name !== $currentPage && $currentPage !== 'login') {
    //                 $endTime = now();
    //                 $timeSpent = $this->calculateTimeSpent($lastActivity->start_time, $endTime);

    //                 $lastActivity->update([
    //                     'end_time' => $endTime,
    //                     'time_spent' => $timeSpent,
    //                 ]);
    //             }

    //             // Create a new record if there is no ongoing activity or the user moved to a new page (excluding 'login' and 'dashboard')
    //             if (!$lastActivity || ($lastActivity->page_name !== $currentPage && $currentPage !== 'login')) {

    //                 // Retrieve unic_id from the session
    //                 $unicId = Session::get('unic_id');
    //                 // dd($unicId);

    //                 UserActivity::create([
    //                     'local_user_id' => $userData->id,
    //                     'unic_id' => $unicId,
    //                     'page_name' => $currentPage,
    //                     'url' => $currentUrl,
    //                     'start_time' => now(),
    //                     'end_time' => now(), // Initialize end_time with the current time
    //                     'time_spent' => 0,
    //                     'session_id' => $sessionId,
    //                 ]);
    //             }
    //         }
    //     }

    //     return $response;
    // }

    // Helper method to calculate time spent
    private function calculateTimeSpent($startTime, $endTime)
    {
        return $startTime->diffInSeconds($endTime);
    }

    // public function handle($request, Closure $next)
    // {
    //     $response = $next($request);

    //     // Check if the user is authenticated
    //     if (Auth::check()) {
    //         $user = Auth::user();
    //         $currentPage = $request->route()->getName();
    //         $currentUrl = $request->url();
    //         $sessionId = Session::getId();
    //         // $unicId = Session::get('unic_id');
    //         // dd($unicId);
    //         // Check if the user should be excluded
    //         if ($this->shouldExcludeUser($user)) {
    //             return $response;
    //         }

    //         // Generate dynamic route name based on parameters
    //         $dynamicRouteName = $this->generateDynamicRouteName($request->route()->parameters(), $currentPage);

    //         // Retrieve last activity
    //         $lastActivity = UserActivity::where('local_user_id', $user->id)
    //             ->where('session_id', $sessionId)
    //             ->where('page_name', '<>', 'login') // Exclude 'login' page
    //             ->latest('id')
    //             ->first();

    //         // Update end_time for the last activity if the user moved to a new page (excluding 'login')
    //         if ($lastActivity && $lastActivity->page_name !== $dynamicRouteName && $currentPage !== 'login') {
    //             $endTime = now();
    //             $timeSpent = $this->calculateTimeSpent($lastActivity->start_time, $endTime);

    //             $lastActivity->update([
    //                 'end_time' => $endTime,
    //                 'time_spent' => $timeSpent,
    //             ]);
    //         }

    //         // Create a new record if there is no ongoing activity or the user moved to a new page (excluding 'login' and 'dashboard')
    //         if (!$lastActivity || ($lastActivity->page_name !== $dynamicRouteName && $currentPage !== 'login')) {
    //             // Retrieve unic_id from the session
    //             $unicId = Session::get('unic_id');

    //             UserActivity::create([
    //                 'local_user_id' => $user->id,
    //                 'unic_id' => $unicId,
    //                 'page_name' => $dynamicRouteName,
    //                 'url' => $currentUrl,
    //                 'start_time' => now(),
    //                 'end_time' => now(), // Initialize end_time with the current time
    //                 'time_spent' => 0,
    //                 'session_id' => $sessionId,
    //             ]);
    //         }
    //     }

    //     return $response;
    // }

    // Working on 7/2/24
    // public function handle($request, Closure $next)
    // {
    //     $response = $next($request);

    //     // Check if the user is authenticated
    //     if (Auth::check()) {

    //         $userData = Auth::user();
    //         $currentPage = $request->route()->getName();
    //         $currentUrl = $request->url();
    //         $sessionId = $request->session()->getId();

    //         // Exclude roles that you don't want to track (e.g., 'admin', 'manager')
    //         // $excludedRoles = ['admin', 'manager'];

    //         // Dynamic route name generation based on parameters
    //         $dynamicRouteName = $this->generateDynamicRouteName($request->route()->parameters());

    //         // Check if the user should be excluded
    //         if ($this->shouldExcludeUser(Auth::user())) {
    //             // Exclude the user, no further processing needed

    //             return $response;
    //         }

    //         // If the dynamic route name is blank, fall back to the existing route name
    //         $dynamicRouteName = $dynamicRouteName ?: $currentPage;

    //         // Check if the user role is excluded
    //         // if (!in_array($userData->roles->first()->name, $excludedRoles))

    //         $lastActivity = UserActivity::where('local_user_id', $userData->id)
    //             ->where('session_id', $sessionId)
    //             ->where('page_name', '<>', 'login') // Exclude 'login' page
    //             ->latest('id')
    //             ->first();

    //         // Update end_time for the last activity if the user moved to a new page (excluding 'login')
    //         if ($lastActivity && $lastActivity->page_name !== $dynamicRouteName && $currentPage !== 'login') {
    //             $endTime = now();
    //             $timeSpent = $this->calculateTimeSpent($lastActivity->start_time, $endTime);

    //             $lastActivity->update([
    //                 'end_time' => $endTime,
    //                 'time_spent' => $timeSpent,
    //             ]);
    //         }

    //         // Create a new record if there is no ongoing activity or the user moved to a new page (excluding 'login' and 'dashboard')
    //         if (!$lastActivity || ($lastActivity->page_name !== $dynamicRouteName && $currentPage !== 'login')) {

    //             // Retrieve unic_id from the session
    //             $unicId = Session::get('unic_id');

    //             UserActivity::create([
    //                 'local_user_id' => $userData->id,
    //                 'unic_id' => $unicId,
    //                 'page_name' => $dynamicRouteName,
    //                 'url' => $currentUrl,
    //                 'start_time' => now(),
    //                 'end_time' => now(), // Initialize end_time with the current time
    //                 'time_spent' => 0,
    //                 'session_id' => $sessionId,
    //             ]);
    //         }
    //         // Check if the request is for logout
    //         // if ($request->route()->getName() === 'logout') {
    //         //     // Record logout activity
    //         //     $this->logLogoutActivity($userData);
    //         // }
    //     }

    //     return $response;
    // }
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Check if the user is authenticated
        if (Auth::check()) {
            $userData = Auth::user();
            $currentPage = $request->route()->getName();
            $currentUrl = $request->url();
            $sessionId = $request->session()->getId();

            // Exclude roles that you don't want to track (e.g., 'admin', 'manager')
            // $excludedRoles = ['admin', 'manager'];

            // Dynamic route name generation based on parameters
            $dynamicRouteName = $this->generateDynamicRouteName($request->route()->parameters());

            // Check if the user should be excluded
            if ($this->shouldExcludeUser($userData)) {
                // Exclude the user, no further processing needed
                return $response;
            }

            // If the dynamic route name is blank, fall back to the existing route name
            $dynamicRouteName = $dynamicRouteName ?: $currentPage;

            // Check if the user role is excluded
            // if (!in_array($userData->roles->first()->name, $excludedRoles))

            // Exclude 'login' page from activity tracking
            if ($currentPage !== 'login' && !Str::contains($currentUrl, '/update-end-time')) {
                // Retrieve the last activity for the user and session
                $lastActivity = UserActivity::where('local_user_id', $userData->id)
                    ->where('session_id', $sessionId)
                    ->where('page_name', '<>', 'login')
                    ->latest('id')
                    ->first();

                // Update end_time for the last activity if the user moved to a new page
                // if ($lastActivity && $lastActivity->page_name !== $dynamicRouteName || ($lastActivity->page_name !== $dynamicRouteName && $currentPage !== 'login')) {
                  
                //     $lastActivity->update([
                        
                //         'end_time' => now(),
                //         'time_spent' => $this->calculateTimeSpent($lastActivity->start_time, now()),
                //     ]);
                // }
                if ($lastActivity !== null && ($lastActivity->page_name !== $dynamicRouteName || ($lastActivity->page_name !== $dynamicRouteName && $currentPage !== 'login'))) {
                    $lastActivity->update([
                        'end_time' => now(),
                        'time_spent' => $this->calculateTimeSpent($lastActivity->start_time, now()),
                    ]);
                }
              
                // Create a new record if there is no ongoing activity or the user moved to a new page
                if (!$lastActivity || ($lastActivity->page_name !== $dynamicRouteName)) {
                    // Retrieve unic_id from the session
                    $unicId = Session::get('unic_id');
                  
                    UserActivity::create([
                        'local_user_id' => $userData->id,
                        'unic_id' => $unicId,
                        'page_name' => $dynamicRouteName,
                        'url' => $currentUrl,
                        'start_time' => now(),
                        'end_time' => now(), // Initialize end_time with the current time
                        'time_spent' => 0,
                        'session_id' => $sessionId,
                    ]);
                }
            }
        }

        return $response;
    }

    protected function generateDynamicRouteName($parameters)
    {

        // Define the keys that correspond to the page name
        // $pageNameKeys = ['page_name', 'name', 'title']; // Add more keys if needed

        // // Filter the array to only include values with keys matching $pageNameKeys
        // $filteredParameters = collect($parameters)
        //     ->only($pageNameKeys)
        //     ->values() // Get the values without the keys
        //     ->implode(' '); // Concatenate the values into a single string

        // return $filteredParameters;

        // # this is well
        //     $segments = collect($parameters)->map(function ($value, $key) {
        //         return $key . '-' . $value;
        //     });

        //    return implode('.', $segments->toArray());

        $segments = collect($parameters)->map(function ($value, $key) {
            return $key . '.' . ($value ?: 'all');
        });
        
        return implode('.', $segments->toArray());
    }



    public function logLoginActivity($user)
    {
        if ($this->shouldExcludeUser(Auth::user())) {
            return response();
        }

        UserActivity::create([
            'local_user_id' => $user->id,
            'unic_id' => Session::get('unic_id'),
            'page_name' => 'login',
            'url' => '',
            'start_time' => now(),
            'end_time' => now(), // Initialize end_time with the current time
            'time_spent' => 0,
            'session_id' => Session::getId(),
        ]);
    }



    public function logLogoutActivity($user)
    {
        // Check if the user is authenticated before accessing user data
        Auth::check();
        $user = Auth::user();

        // Check if the user should be excluded
        if ($this->shouldExcludeUser($user)) {
            return;
        }
        // Proceed with logging logout activity
        $lastActivity = UserActivity::where('session_id', Session::getId())
            ->where('page_name', '<>', 'logout') // Exclude 'logout' page
            ->latest('id')
            ->first();

        if ($lastActivity) {
            $lastActivity->update([
                'end_time' => now(),
                'time_spent' => $this->calculateTimeSpent($lastActivity->start_time, now()),
            ]);
        }

        // Create a new record for logout activity
        UserActivity::create([
            'local_user_id' => $user->id,
            'unic_id' => Session::get('unic_id'),
            'page_name' => 'logout',
            'url' => '',
            'start_time' => now(),
            'end_time' => now(), // Initialize end_time with the current time
            'time_spent' => 0,
            'session_id' => Session::getId(),
        ]);
    }


    public function shouldExcludeUser($user)
    {
        // Check if the user is authenticated and has a role
        if (Auth::check() && $user->hasRole(['admin', 'manager',])) {
            // Log a message indicating that the user is excluded
            Log::info('User is excluded.');
            return true; // User should be excluded
        }

        return false; // User should not be excluded
    }


    // Enhanced
    // protected function generateDynamicRouteName($parameters, $separator = '.', $excludedParameters = [])
    // {
    //     $segments = collect($parameters)->reject(function ($value, $key) use ($excludedParameters) {
    //         return in_array($key, $excludedParameters);
    //     })->map(function ($value, $key) use ($separator) {
    //         return $key . $separator . $value;
    //     });

    //     return $segments->implode($separator);
    // }
}
