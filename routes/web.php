<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\SchoolclassController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Teachers\CourseController;
use App\Http\Controllers\Headmaster\DataController;
use App\Http\Controllers\Students\StudyController;
use App\Http\Controllers\User\ProfileController;

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
        Route::get('courses', [StudyController::class, 'index'])->name('courses');
        Route::get('courses/{course}/subject', [StudyController::class, 'showSubject'])->name('courses.subject');
        Route::get('courses/{course}/subject/{subject}', [StudyController::class, 'showSubjectDetails'])->name('courses.subject.details');
        Route::get('courses/{course}/subject/{subject}/download', [StudyController::class, 'download'])->name('courses.subject.download');
    });

   Route::group(['middleware' => 'role:teacher', 'prefix' => 'teacher', 'as' => 'teacher.'], function() {
        Route::resource('courses', CourseController::class);
        Route::get('courses/{courses}/subjectmatters', [CourseController::class, 'showSubject'])->name('subjectmatters');
   });

    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('dashboard', DashboardController::class)->name('dashboard');
        Route::resource('students', StudentController::class);
        Route::resource('teachers', TeacherController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('schoolclasses', SchoolclassController::class);
        Route::resource('users', UserController::class);
    });

    Route::group(['middleware' => 'role:headmaster', 'prefix' => 'headmaster', 'as' => 'headmaster.'], function() {
        Route::resource('data', DataController::class);
    });
});
