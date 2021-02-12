<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Students\LessonController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Teachers\CourseController;
use App\Http\Controllers\Headmaster\DataController;
use App\Http\Controllers\Students\SubjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'role:student', 'prefix' => 'student', 'as' => 'student.'], function() {
        Route::resource('lessons', LessonController::class);
        Route::resource('lessons.subjectmatters', SubjectController::class);
    });
   Route::group(['middleware' => 'role:teacher', 'prefix' => 'teacher', 'as' => 'teacher.'], function() {
       Route::resource('courses', CourseController::class);
   });
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::resource('users', UserController::class);
    });
    Route::group(['middleware' => 'role:headmaster', 'prefix' => 'headmaster', 'as' => 'headmaster.'], function() {
        Route::resource('data', DataController::class);
    });
});
