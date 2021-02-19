<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Students\LessonController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Teachers\CourseController;
use App\Http\Controllers\Headmaster\DataController;
use App\Http\Controllers\Students\SubjectController;
use App\Http\Controllers\User\ProfileController;
use App\Models\Admin;

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
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile');
        Route::patch('/{userid}/{profileid}', [ProfileController::class, 'update'])->name('profile.update');
    });
    
    Route::group(['middleware' => 'role:student', 'prefix' => 'student', 'as' => 'student.'], function() {
        Route::resource('lessons', LessonController::class);
        Route::get('lessons/{lesson}/subjectmatters/{subjectmatter}/download', [SubjectController::class, 'download'])->name('subject.download');
        Route::resource('lessons.subjectmatters', SubjectController::class);
    });

   Route::group(['middleware' => 'role:teacher', 'prefix' => 'teacher', 'as' => 'teacher.'], function() {
        Route::resource('courses', CourseController::class);
        Route::get('courses/{courses}/subjectmatters', [CourseController::class, 'showSubject'])->name('subjectmatters');
   });

    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('users', [AdminController::class, 'showUsers'])->name('users');
        Route::get('students', [AdminController::class, 'showStudents'])->name('students');
        Route::resource('dashboard', AdminController::class);
    });

    Route::group(['middleware' => 'role:headmaster', 'prefix' => 'headmaster', 'as' => 'headmaster.'], function() {
        Route::resource('data', DataController::class);
    });
});
