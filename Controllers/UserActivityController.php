<?php

namespace App\Http\Controllers;

use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class UserActivityController extends Controller
{
    //

    // public function updateEndTime(Request $request)
    // {

    //     $token = $request->bearerToken(); // Extract token from the request

    //     if ($token) {
    //         // Perform your authentication logic using the token
    //         $user = $this->getUserFromToken($token);

    //         if ($user) {
    //             $currentPage = $request->route()->getName();

    //             $lastActivity = UserActivity::where('user_id', $user->id)
    //                 ->latest()
    //                 ->first();

    //             // Update end_time and time_spent if the user is on a different page
    //             if ($lastActivity && $lastActivity->page_name !== 'login' && $currentPage !== 'login' && $lastActivity->session_id === Session::getId()) {
    //                 $endTime = now();
    //                 $timeSpent = $this->calculateTimeSpent($lastActivity->start_time, $endTime);

    //                 $lastActivity->update([
    //                     'end_time' => $endTime,
    //                     'time_spent' => $timeSpent,
    //                 ]);
    //             }
    //         }
    //     }

    //     return response()->json(['success' => true]);
    // }

    // public function updateEndTime(Request $request)
    // {
    //     // Perform the logic to update end time
    //     // This logic will not be traced as an activity
    //     // For example:
    //     $userId = Auth::id();

    //     if ($userId) {
    //         $lastActivity = UserActivity::where('user_id', $userId)
    //             ->latest()
    //             ->first();

    //         if ($lastActivity) {
    //             $lastActivity->update(['end_time' => now()]);
    //         }
    //     }

    //     return response()->json(['success' => true]);
    // }

    public function updateEndTime(Request $request)
    {
        $localUserId = Auth::id();

        if ($localUserId) {
            $sessionId = $request->session()->getId();

            $lastActivity = UserActivity::where('local_user_id', $localUserId)
                ->where('session_id', $sessionId)
                ->where('page_name', '<>', 'login')
                ->latest()
                ->first();

            if ($lastActivity) {
                $startTime = $lastActivity->start_time;
                $endTime = now();
                $timeSpent = $this->calculateTimeSpent($startTime, $endTime);

                $lastActivity->update([
                    'end_time' => $endTime,
                    'time_spent' => $timeSpent,
                ]);
            }
        }

        return response()->json(['success' => true]);
    }

    // Helper function to calculate time spent
    private function calculateTimeSpent($startTime, $endTime)
    {
        return $startTime->diffInSeconds($endTime);
    }

    public function index()
    {
        // $users = User::all();


        // Fetch all users along with their member profiles
        //$usersWithProfiles = User::with('profile')->get();
        // // Eager loading to avoid N+1 queries
        //    $activities = UserActivity::with('profile')->get(); 

        $activities = UserActivity::with('profile')->orderBy('created_at', 'desc')->get();


        // $activities = UserActivity::with('profile')->latest()->paginate(10);
           
        // $activities = UserActivity::with('profile')->whereIn('page_name', ['login', 'logout'])->get();
        return view('manage.activities.index', compact('activities'));
    }

    public function activity()
    {
        // $profile = Profile::with('activities')->where('unic_id', $unic_id)->first();
        $activities = UserActivity::with('profile')
            ->whereHas('profile', function ($query) {
                $query->where('position', 'faculty');
            })->get();
        return view('activity.show', compact('activities'));
    }

    public function index2()
    {
        // Step 1: Retrieve the activity data from your database and organize it
        $activitySummary = UserActivity::with('profile')
            ->select([
                'user_activities.local_user_id',
                'user_activities.unic_id',
                'user_activities.session_id',
                UserActivity::raw('DATE(user_activities.created_at) as date'),
                UserActivity::raw('SUM(user_activities.time_spent) as total_time_spent'),
                UserActivity::raw('MIN(user_activities.created_at) as from_time'),
                UserActivity::raw('MAX(user_activities.created_at) as to_time')
            ])
            // ->join('profile', 'user_activities.local_user_id', '=', 'profile.user_id')
            ->groupBy('user_activities.local_user_id', 'user_activities.unic_id', 'date', 'user_activities.session_id')
            ->orderBy('date', 'desc')
            ->get();

        // Step 2: Display the organized data
        // echo "Date\t\tUser ID\t\tUnique ID\t\tTotal Time Spent\n";
        // foreach ($activitySummary as $activity) {
        //     echo $activity->date . "\t" . $activity->local_user_id . "\t\t" . $activity->unic_id . "\t\t" . $activity->total_time_spent . " seconds\n";
        // }
        return view('manage.activities.index2', compact('activitySummary'));
    }

    public function index3()
    {
        // Step 1: Retrieve the activity data from your database and organize it
        $activitySummary = UserActivity::select(
            UserActivity::raw('DATE(created_at) as date'),
            'local_user_id',
            'unic_id',
            UserActivity::raw('COUNT(DISTINCT session_id) as total_sessions'),
            UserActivity::raw('SUM(time_spent) as total_time_spent'),
            UserActivity::raw('SUM(time_spent) / COUNT(DISTINCT session_id) as avg_time_spent_per_session'),
            UserActivity::raw('MIN(user_activities.created_at) as from_time'),
            UserActivity::raw('MAX(user_activities.created_at) as to_time')
        )
            ->groupBy('date', 'local_user_id', 'unic_id')
            ->orderBy(UserActivity::raw('MAX(user_activities.created_at)'), 'desc')  // Order by the latest created_at
            ->get();
        // Step 2: Display the organized data
        // echo "Date\t\tUser ID\t\tUnique ID\t\tTotal Time Spent\n";
        // foreach ($activitySummary as $activity) {
        //     echo $activity->date . "\t" . $activity->local_user_id . "\t\t" . $activity->unic_id . "\t\t" . $activity->total_time_spent . " seconds\n";
        // }
        return view('manage.activities.index3', compact('activitySummary'));
    }


    public function index4()
    {
        // $users = User::all();


        // Fetch all users along with their member profiles
        //$usersWithProfiles = User::with('profile')->get();
        // // Eager loading to avoid N+1 queries
           $activities = UserActivity::with('profile')->orderBy('created_at', 'desc')->get(); 

        // $activities = UserActivity::with('profile')->latest()->paginate(10);
           
        // $activities = UserActivity::with('profile')->whereIn('page_name', ['login', 'logout'])->get();
        return view('manage.activities.index4', compact('activities'));
    }

    public function index5()
    {
           $activities = UserActivity::with('profile')->orderBy('created_at', 'desc')->get(); 
        return view('manage.activities.index5', compact('activities'));
    }
}
