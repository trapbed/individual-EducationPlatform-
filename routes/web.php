<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LessonController;
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
        Route::get('/admin/edit_cat_show/{id}', [CategoryController::class, 'edit_cat_show'])->name('edit_cat_show');
        Route::post('/admin/edit_cat', [CategoryController::class, 'edit_cat'])->name('edit_cat');
        Route::get('change_exist_category/{exist}/{id}', [CategoryController::class, 'change_exist_category'])->name('change_exist_category');
    });    
    
    Route::middleware('student')->group(function(){
        Route::get('student/account', function(){return view('student/account');})->name('student_account');
    });

    // $id_user, $id_appl, $role, $status_appl
    

    Route::middleware('author')->group(function(){
        Route::get('/author/courses', [CourseController::class, 'main_courses'])->name('main_author');
        Route::get('author/update_course/{id_course}', [CourseController::class, 'update_course'])->name('update_course');
        Route::get('/author_more_info_course/{id}', [CourseController::class, 'author_more_info_course'])->name('author_more_info_course');
        Route::get('/create_lesson_show/{id}', [CourseController::class, 'data_for_create_course'])->name('create_lesson_show');
        Route::post('/create_lesson', [LessonController::class, 'create_lesson'])->name('create_lesson');
        Route::get('/remove_lesson/{id_less}/{id_course}', [LessonController::class, 'remove_lesson'])->name('remove_lesson');
        Route::get('/one_lesson/{id}', [LessonController::class, 'one_lesson'])->name('one_lesson');

        Route::post('/application_courses', [CourseController::class, 'application_courses'])->name('application_courses');
        Route::post('/add_to_dir', [LessonController::class, 'add_to_dir'])->name('add_to_dir');
        Route::get('/get_images_lesson', [LessonController::class, 'images_lesson'])->name('get_images_lesson');
    });
});



// Route::middleware('admin')->group(function () {
// });