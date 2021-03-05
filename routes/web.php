<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\{AdminAccumulationController, AdminAssignmentController, AdminQuizController, AdminSubjectController, AdminTaskController, CourseController, DashboardController, DepartmentController, MappingController, SchoolclassController, StudentController, TeacherController, UserController};
use App\Http\Controllers\Headmaster\DataController;
use App\Http\Controllers\Students\StudyController;
use App\Http\Controllers\Teachers\{AccumulationController, TaskController, SubjectController, AssignmentController, TeacherCourseController, TeacherDashboardController, TeacherDepartmentController, TeacherSchoolclassController, TeacherStudentController};
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
        
        Route::get('courses/{course}/subject/{subject}/assignment', [StudyController::class, 'showAssignment'])->name('courses.subject.assignment');
        Route::get('courses/{course}/subject/{subject}/assignment/{assignment}', [StudyController::class, 'showAssignmentDetails'])->name('courses.subject.assignment.details');
        Route::post('courses/{course}/subject/{subject}/assignment/{assignment}', [StudyController::class, 'storeAccumulation'])->name('courses.subject.assignment.store');
        Route::delete('courses/{course}/subject/{subject}/assignment/{assignment}/{attachment}', [StudyController::class, 'deleteAccumulation'])->name('courses.subject.assignment.destroy');
        Route::get('courses/{course}/subject/{subject}/assignment/{assignment}/download', [StudyController::class, 'downloadAssignment'])->name('courses.subject.assignment.download');
    });

   Route::group(['middleware' => 'role:teacher', 'prefix' => 'teacher', 'as' => 'teacher.'], function() {
        Route::get('dashboard', TeacherDashboardController::class)->name('dashboard');
        Route::resource('students', TeacherStudentController::class);
        Route::resource('departments', TeacherDepartmentController::class);
        Route::resource('schoolclasses', TeacherSchoolclassController::class);
        Route::resource('course', TeacherCourseController::class);

        Route::get('tasks/{class}', TaskController::class)->name('tasks');
        Route::resource('assignment', AssignmentController::class)->except([
            'create', 'edit', 'show'
        ]);
        Route::get('assignment/{class}/create', [AssignmentController::class, 'create'])->name('assignment.create');
        Route::get('assignment/{class}/{assignment}/edit', [AssignmentController::class, 'edit'])->name('assignment.edit');
        Route::get('assignment/{class}/{assignment}', [AssignmentController::class, 'show'])->name('assignment.show');

        Route::get('assignment/{class}/{assignment}/student-work', [AccumulationController::class, 'index'])->name('accumulation.index');
        Route::get('assignment/{class}/{assignment}/student-work/{student}/{accumulation}', [AccumulationController::class, 'show'])->name('accumulation.show');
        Route::patch('assignment/{class}/{assignment}/student-work/{student}/point', [AccumulationController::class, 'updatePoint'])->name('accumulation.update');
        Route::get('assignment/{class}/{assignment}/student-work/{student}/{accumulation}/download', [AccumulationController::class, 'download'])->name('accumulation.download');

        Route::resource('courses', SubjectController::class);
        Route::get('courses/{courses}/subjectmatters', [SubjectController::class, 'showSubject'])->name('subjectmatters');
        Route::get('courses/{course}/subjectmatters/{subject}', [SubjectController::class, 'showSubjectDetails'])->name('subjectmatters.details');
        Route::get('courses/{course}/subjectmatters/{subject}/download', [SubjectController::class, 'download'])->name('subjectmatters.download');
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
    
        Route::resource('course', AdminSubjectController::class);
        Route::get('course/{course}/subjectmatters', [AdminSubjectController::class, 'showSubject'])->name('subjectmatters');
        Route::get('courses/{course}/subjectmatters/{subject}', [AdminSubjectController::class, 'showSubjectDetails'])->name('subjectmatters.details');
        Route::get('courses/{course}/subjectmatters/{subject}/download', [AdminSubjectController::class, 'download'])->name('subjectmatters.download');

        Route::get('tasks/{class}', AdminTaskController::class)->name('tasks');

        Route::get('assignment/{class}/create', [AdminAssignmentController::class, 'create'])->name('assignment.create');
        Route::post('assignment', [AdminAssignmentController::class, 'store'])->name('assignment.store');
        Route::get('assignment/{class}/{assignment}', [AdminAssignmentController::class, 'show'])->name('assignment.show');
        Route::get('assignment/{class}/{assignment}/edit', [AdminAssignmentController::class, 'edit'])->name('assignment.edit');
        Route::patch('assignment/{assignment}', [AdminAssignmentController::class, 'update'])->name('assignment.update');
        
        Route::get('quiz/{class}/create', [AdminQuizController::class, 'create'])->name('quiz.create');
        Route::post('quiz', [AdminQuizController::class, 'store'])->name('quiz.store');

        Route::delete('assignment/{assignment}', [AdminAssignmentController::class, 'destroy'])->name('assignment.destroy');

        Route::get('assignment/{class}/{assignment}/student-work', [AdminAccumulationController::class, 'index'])->name('accumulation.index');
        Route::get('assignment/{class}/{assignment}/student-work/{student}/{accumulation}', [AdminAccumulationController::class, 'show'])->name('accumulation.show');
        Route::patch('assignment/{class}/{assignment}/student-work/{student}/point', [AdminAccumulationController::class, 'updatePoint'])->name('accumulation.update');
        Route::get('assignment/{class}/{assignment}/student-work/{student}/{accumulation}/download', [AdminAccumulationController::class, 'download'])->name('accumulation.download');


    });

    Route::group(['prefix' => 'headmaster', 'as' => 'headmaster.'], function() {
        Route::resource('data', DataController::class);
    });
});
