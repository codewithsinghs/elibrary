<?php

use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Data\CourseController;
use App\Http\Controllers\Data\RoleController;
use App\Http\Controllers\Data\UserController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\UserActivityController;
use App\Http\Controllers\Data\ResourceController;
use App\Http\Controllers\data\UserRolesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', function () {
//         $user = Auth::user();

//         // Determine the appropriate dashboard based on user role
//         $dashboardView = match ($user->getRoleNames()->first()) {


//             'admin' => 'admin.dashboard',
//             'manager' => 'manager.dashboard',
//             'librarian' => 'librarian.dashboard',
//             'teacher' => 'teacher.dashboard',
//             'student' => 'student.dashboard',
//             'member' => 'member.dashboard',
//             default => 'dashboard', // Default to a generic dashboard
//         };

//         return view($dashboardView);
//     })->name('dashboard'); // Add a name to the route
// });
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


// Route::middleware(['auth'])->group(function () {
//     // Admin Routes
//     Route::middleware(['role:admin'])->group(function () {
//         Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
//         // Add more routes as needed for admin
//     });

//     // Librarian Routes
//     Route::middleware(['role:librarian'])->group(function () {
//         Route::get('/librarian', [LibrarianController::class, 'index'])->name('librarian.dashboard');
//         // Add more routes as needed for librarian
//     });

//     // Member Routes
//     Route::middleware(['role:member'])->group(function () {
//         Route::get('/member', [MemberController::class, 'index'])->name('member.dashboard');
//         // Add more routes as needed for member
//     });

//     // Teacher Routes
//     Route::middleware(['role:teacher'])->group(function () {
//         Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.dashboard');
//         // Add more routes as needed for teacher
//     });

//     // Student Routes
//     Route::middleware(['role:student'])->group(function () {
//         Route::get('/student', [StudentController::class, 'index'])->name('student.dashboard');
//         // Add more routes as needed for student
//     });
// });

Route::middleware(['auth', 'user.activity'])->group(function () {
    Route::post('/update-end-time', [UserActivityController::class, 'updateEndTime']); //this route should not be named

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/complete', [ProfileController::class, 'complete'])->name('profile.complete');
    Route::post('/profile/updates', [ProfileController::class, 'updates'])->name('profile.updates');

    // Common Routes for Managing Users and Books
    Route::middleware(['role:admin|manager|librarian', 'permission:manage_users|manage_contents|borrow_books|manage_e_content|activate_member_subscription|deactivate_member_subscription'])->group(function () {
        // Resourceful routes for managing users
        Route::resource('users', UserController::class);
        Route::put('/users/{user}/update-status', [UserController::class, 'updateStatus'])->name('users.updateStatus');

        Route::get('/activities', [UserActivityController::class, 'index'])->name('activities.index');
        Route::get('/sumactivity', [UserActivityController::class, 'index2'])->name('activities.index2');
        Route::get('/sumactivity3', [UserActivityController::class, 'index3'])->name('activities.index3');
        // Resourceful routes for managing Roles
        Route::resource('roles', RoleController::class);

        Route::resource('resources', ResourceController::class);
        Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
        Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
        Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

        // Routes for managing User Roles
        Route::get('users/{user}/edit-roles', [UserRolesController::class, 'edit'])->name('users.roles.edit');
        Route::put('users/{user}/update-roles', [UserRolesController::class, 'update'])->name('users.roles.update');
        // Resourceful routes for managing books
        Route::resource('members', MemberController::class);

        // Add more resourceful routes as needed for managing members, resources, etc.
    });

    // Admin Routes
    Route::middleware(['role:admin', 'permission:manage_users|manage_contents|borrow_books|manage_e_content|activate_member_subscription|deactivate_member_subscription'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

        // Other Admin Routes
        // Route::get('/admin/users', [AdminController::class, 'viewAllUsers'])->name('admin.viewUsers');
        // Route::get('/admin/books', 'AdminController@manageBooks')->name('admin.manageBooks');
        // Add more routes as needed for admin
    });

    // Manager Routes
    Route::middleware(['role:manager', 'permission:manage_users|manage_contents|borrow_books|manage_e_content|activate_member_subscription|deactivate_member_subscription'])->group(function () {
        Route::get('/manager', [ManagerController::class, 'index'])->name('manager.dashboard');
        // Add more routes as needed for manager
    });

    // Librarian Routes
    Route::middleware(['role:librarian', 'permission:manage_users|manage_contents|manage_e_content|activate_member_subscription|deactivate_member_subscription'])->group(function () {
        Route::get('/librarian', [LibrarianController::class, 'index'])->name('librarian.dashboard');
        // Route::get('/profile', [StudentController::class, 'profile'])->name('librarian.dashboard');
        // Add more routes as needed for librarian
    });

    // Teacher Routes
    Route::middleware(['role:teacher', 'permission:manage_users|borrow_books'])->group(function () {
        Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.dashboard');
        // Add more routes as needed for teacher
    });

    // Student Routes
    Route::middleware(['role:student', 'checkToken', 'permission:borrow_books'])->prefix('student')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('student.dashboard');
        // Route::get('/profile', [StudentController::class, 'profile'])->name('student.profile');
        Route::get('/project', [StudentController::class, 'project'])->name('student.project');
        Route::get('/cources', [StudentController::class, 'cources'])->name('student.cources');
        // Route::get('/resources', [StudentController::class, 'resources'])->name('student.resources');
        // Add more routes as needed for student
    });

    // Member Routes
    Route::middleware(['role:member', 'permission:borrow_books'])->group(function () {
        Route::get('/member', [MemberController::class, 'index'])->name('member.dashboard');
        // Add more routes as needed for member
    });
});

require __DIR__ . '/auth.php';
