<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\InstructorController as AdminInstructorController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\LessonController as AdminLessonController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseEnrollmentController; 
use App\Http\Controllers\Admin\ApprovedCoursesController;
use App\Http\Controllers\Admin\HeroSectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Public Routes
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/instructors', [InstructorController::class, 'indexPublic'])->name('instructors.index');
Route::get('/instructors/{instructor}', [InstructorController::class, 'show'])->name('instructors.show');

// الصفحات الثابتة
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendContact'])->name('contact.send');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user/enrolled-courses', [UserController::class, 'enrolledCourses'])->name('user.enrolled-courses');
    Route::middleware(['auth'])->group(function () {
        // Course Enrollment
        Route::post('/courses/{course}/enroll', [CourseEnrollmentController::class, 'enroll'])->name('courses.enroll');
        Route::get('/courses/{course}/learn', [CourseEnrollmentController::class, 'learn'])->name('courses.learn');
    });

    // مسارات المستخدم
    Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
        Route::get('/enrolled-courses', [UserController::class, 'enrolledCourses'])->name('enrolled-courses');
        Route::get('/my-enrollments', [UserController::class, 'myEnrollments'])->name('my-enrollments');
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    });

    // Admin Routes
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        
        // Admin Category Management
        Route::resource('categories', AdminCategoryController::class);
        
        Route::resources([
            'instructors' => AdminInstructorController::class,
        ]);

        Route::resources([
            'courses' => AdminCourseController::class,
        ]);

        Route::resources([
            'users' => AdminUserController::class
        ]);

        // Lessons Management
        Route::resource('lessons', AdminLessonController::class);

        Route::resource('specializations', SpecializationController::class);

        // مسارات إدارة طلبات الاشتراك
        Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
        Route::put('/enrollments/{enrollment}/approve', [EnrollmentController::class, 'approve'])->name('enrollments.approve');
        Route::put('/enrollments/{enrollment}/reject', [EnrollmentController::class, 'reject'])->name('enrollments.reject');

        // مسارات الكورسات المعتمدة
        Route::get('/approved-courses', [ApprovedCoursesController::class, 'index'])->name('approved-courses.index');

        // Hero Sections Routes
        Route::resource('hero-sections', \App\Http\Controllers\Admin\HeroSectionController::class);
    });
});

require __DIR__.'/auth.php';
