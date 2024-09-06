<?php

use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Data\RoleController;
use App\Http\Controllers\Data\UserController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\Data\CourseController;
use App\Http\Controllers\UserActivityController;
use App\Http\Controllers\Data\ResourceController;
use App\Http\Controllers\data\UserRolesController;
use App\Http\Controllers\Data\SupportTicketController;
use App\Http\Controllers\Data\AcademicEntityController;
use Illuminate\Support\Facades\Storage;

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

Route::get('', [DashboardController::class, 'home'])->name('home')->middleware(['web', 'user.activity']);


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

    // Route::get('/contact', [SupporvtController::class, 'create']);
    // Route::post('/contact', [SupportController::class, 'store']);

    Route::get('/support/attachment/{id}/download', [SupportTicketController::class, 'downloadAttachment'])->name('support.attachment.download');
    Route::get('/support', [SupportController::class, 'index'])->name('support.index');
    Route::get('/support/open', [SupportController::class, 'open'])->name('support.index-open');
    Route::get('/support/create', [SupportController::class, 'create'])->name('support.create');
    Route::post('/support/store', [SupportController::class, 'store'])->name('support.store');
    Route::get('/support/{ticket_id}', [SupportController::class, 'show'])->name('tickets.show');
    Route::post('/support/{ticket_id}/reply', [SupportController::class, 'reply'])->name('support-ticket.reply');
});

Route::get('storage/{path}', function ($path) {
    // Ensure the user is authenticated
    if (!Auth::check()) {
        abort(403, 'Unauthorized');
    }

    $filePath = storage_path('app/public/' . $path);

    if (!file_exists($filePath)) {
        abort(404, 'File not found');
    }

    $file = file_get_contents($filePath);
    $type = mime_content_type($filePath);

    return response($file, 200)->header('Content-Type', $type);
})->where('path', '.*')->middleware('auth')->name('storage.file');

// Route::get('storage/{folder}/{filename}', function ($folder, $filename) {
//     // Ensure the user is authenticated
//     if (!Auth::check()) {
//         abort(403, 'Unauthorized');
//     }

//     $path = storage_path('app/public/' . $folder . '/' . $filename);

//     if (!file_exists($path)) {
//         abort(404, 'File not found');
//     }

//     $file = file_get_contents($path);
//     $type = mime_content_type($path);

//     return response($file, 200)->header('Content-Type', $type);
// })->where(['folder' => '.*', 'filename' => '.*'])->middleware('auth')->name('storage.file');



Route::middleware(['auth', 'user.activity'])->group(function () {
    Route::post('/update-end-time', [UserActivityController::class, 'updateEndTime']); //this route should not be named
    // Route::get('/', [DashboardController::class, 'home'])->name('home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/complete', [ProfileController::class, 'complete'])->name('profile.complete');
    Route::post('/profile/updates', [ProfileController::class, 'updates'])->name('profile.updates');

    // Example: Common Courses (accessible to all students and members and so on)
    Route::get('/resources', [HomeController::class, 'resources'])->name('resources');
    Route::get('/resources/{resource}', [HomeController::class, 'viewResource'])->name('resources.view');
    // Example: Common Courses (accessible to all students and members and so on)
    Route::get('/courses',  [HomeController::class, 'courses'])->name('courses');
    Route::get('/courses/{course}', [HomeController::class, 'viewCourse'])->name('courses.view');

    // Common Routes for Managing Users and Books
    Route::middleware(['role:admin|manager|librarian', 'permission:manage_users|manage_contents|borrow_books|manage_e_content|activate_member_subscription|deactivate_member_subscription'])->prefix('manage')->group(function () {
        // Resourceful routes for managing users
        Route::resource('users', UserController::class);
        Route::put('/users/{user}/update-status', [UserController::class, 'updateStatus'])->name('users.updateStatus');

        Route::get('/activities', [UserActivityController::class, 'index'])->name('activities.index');
        Route::get('/sumactivity', [UserActivityController::class, 'index2'])->name('activities.index2');
        Route::get('/sumactivity3', [UserActivityController::class, 'index3'])->name('activities.index3');
        Route::get('/sumactivity4', [UserActivityController::class, 'index4'])->name('activities.index4');
        Route::get('/sumactivity5', [UserActivityController::class, 'index5'])->name('activities.index5');
        // Resourceful routes for managing Roles
        Route::resource('academics', AcademicEntityController::class);
        Route::resource('roles', RoleController::class);

        Route::resource('resources', ResourceController::class);
        Route::resource('courses', CourseController::class);

        // Routes for managing User Roles
        Route::get('users/{user}/edit-roles', [UserRolesController::class, 'edit'])->name('users.roles.edit');
        Route::put('users/{user}/update-roles', [UserRolesController::class, 'update'])->name('users.roles.update');

        // Resourceful routes for managing books
        Route::resource('members', MemberController::class);

        // Add more resourceful routes as needed for managing members, resources, etc.

        // Route::get('/support', [SupportController::class, 'index'])->name('admin.support.index');
        // Route::post('/support/{query}/reply', [SupportController::class, 'reply']);

        Route::get('/support/tickets/create', [SupportTicketController::class, 'create'])->name('support-tickets.create');
        Route::get('/support/tickets', [SupportTicketController::class, 'index'])->name('support-tickets.index');
        Route::get('/support/tickets/open', [SupportTicketController::class, 'open'])->name('support-tickets.index-open');
        Route::get('/support/tickets/{id}', [SupportTicketController::class, 'show'])->name('support-tickets.show');
        Route::post('/support/tickets/{ticket_id}/reply', [SupportTicketController::class, 'reply'])->name('support-tickets.reply');
        Route::delete('/support-tickets/{ticket_id}', [SupportTicketController::class, 'destroy'])->name('support-tickets.destroy');
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
        // Route::get('/project', [StudentController::class, 'project'])->name('student.project');
        // Route::get('/cources', [StudentController::class, 'cources'])->name('student.cources');
        // Route::get('/resources', [StudentController::class, 'resources'])->name('student.resources');
        // Add more routes as needed for student
    });

    // Member Routes
    Route::middleware(['role:member', 'permission:borrow_books'])->group(function () {
        Route::get('/member', [MemberController::class, 'index'])->name('member.dashboard');
        // Add more routes as needed for member
    });
});

        // Include the custom routes
       // require base_path('routes/custom.php');
        require __DIR__ . '/custom.php';
require __DIR__ . '/auth.php';
