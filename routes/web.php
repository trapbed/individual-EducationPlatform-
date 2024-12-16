<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('no_admin_no_author')->group(function(){
    Route::get('/', [CourseController::class, 'main'])->name('main');
    Route::get('/courses/{search?}/{category?}/{order?}', [CourseController::class, 'main_courses'])->name('courses');
    Route::get('/one_course_main/{id_course}', [CourseController::class, 'one_course_main'])->name('one_course_main');
});
    

Route::middleware('no_auth')->group(function(){
    Route::get('/login', function(){return view('login');})->name('login');
    Route::post('/login_db', [AuthController::class, 'login_db'])->name('login_db');

    Route::get('/signup', function(){return view('signup');})->name('signup_form');
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
});

// Route::post('/', [AuthController::class, 'login_modal']);


Route::middleware('auth')->group(function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    

    Route::middleware('admin')->group(function(){
        Route::get('admin/main', [UserController::class, 'all_users_admin'])->name('main_admin');
        Route::get('admin/courses', [CourseController::class, 'get_all_admin'])->name('courses_admin');
        Route::get('change_access_course/{access}/{id_course}', [CourseController::class, 'change_access_course'])->name('change_access_course');
        Route::get('change_blocked/{id_user}/{blocked}', [UserController::class, 'change_blocked'])->name('change_blocked');
        Route::get('admin/users_appl', [UserController::class, 'users_appl'])->name('users_appl');
        Route::get('change_role/{id_user}/{id_appl}/{role}/{status_appl}', [UserController::class, 'change_role'])->name('change_role');
        Route::get('admin/categories_admin', [CategoryController::class, 'categories_admin'])->name('categories_admin');
        Route::post('/create_category', [CategoryController::class, 'create_category'])->name('create_category');
        Route::get('change_exist_category/{exist}/{id}', [CategoryController::class, 'change_exist_category'])->name('change_exist_category');
    });    
    
    Route::middleware('student')->group(function(){
        Route::get('student/account', function(){return view('student/account');})->name('student_account');
    });

    // $id_user, $id_appl, $role, $status_appl
    

    Route::middleware('author')->group(function(){
        Route::get('/author/courses', function(){return view('author/courses');})->name('main_author');
    });
});



// Route::middleware('admin')->group(function () {
// });