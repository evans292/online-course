<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\{CourseController, DashboardController, DepartmentController, MappingController, SchoolclassController, StudentController, TeacherController, UserController};
use App\Http\Controllers\Headmaster\DataController;
use App\Http\Controllers\Students\StudyController;
use App\Http\Controllers\Teachers\TaskController;
use App\Http\Controllers\Teachers\SubjectController;
use App\Http\Controllers\Teachers\AssignmentController;
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
        Route::get('tasks/{class}', TaskController::class)->name('tasks');
        Route::resource('assignment', AssignmentController::class)->except([
            'create', 'edit', 'show'
        ]);
        Route::get('assignment/{class}/create', [AssignmentController::class, 'create'])->name('assignment.create');
        Route::get('assignment/{class}/{assignment}/edit', [AssignmentController::class, 'edit'])->name('assignment.edit');
        Route::get('assignment/{class}/{assignment}', [AssignmentController::class, 'show'])->name('assignment.show');

        Route::resource('courses', SubjectController::class);
        Route::get('courses/{courses}/subjectmatters', [SubjectController::class, 'showSubject'])->name('subjectmatters');
   });

    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('dashboard', DashboardController::class)->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('students', StudentController::class);
        Route::resource('teachers', TeacherController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('schoolclasses', SchoolclassController::class);
        Route::resource('courses', CourseController::class);

        Route::get('classroom-teacher', [MappingController::class, 'showClassroomTeacher'])->name('classroom-teacher');
        Route::get('classroom-teacher/{class}/edit', [MappingController::class, 'editClassroomTeacher'])->name('classroom-teacher.edit');
        Route::patch('classroom-teacher/{class}', [MappingController::class, 'updateClassroomTeacher'])->name('classroom-teacher.update');

        Route::get('classroom-course', [MappingController::class, 'showClassroomCourse'])->name('classroom-course');
        Route::get('classroom-course/{class}/edit', [MappingController::class, 'editClassroomCourse'])->name('classroom-course.edit');
        Route::patch('classroom-course/{class}', [MappingController::class, 'updateClassroomCourse'])->name('classroom-course.update');

        Route::get('course-teacher', [MappingController::class, 'showCourseTeacher'])->name('course-teacher');
        Route::get('course-teacher/{course}/edit', [MappingController::class, 'editCourseTeacher'])->name('course-teacher.edit');
        Route::patch('course-teacher/{course}', [MappingController::class, 'updateCourseTeacher'])->name('course-teacher.update');
    });

    Route::group(['middleware' => 'role:headmaster', 'prefix' => 'headmaster', 'as' => 'headmaster.'], function() {
        Route::resource('data', DataController::class);
    });
});
