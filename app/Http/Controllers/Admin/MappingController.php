<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Schoolclass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Support\Facades\Gate;

class MappingController extends Controller
{
    //
    public function __construct() {
        $this->middleware('role:admin');
    }

    public function showClassroomTeacher()
    {
       

        $datas = Schoolclass::orderBy('name')->paginate(10);
        return view('admin.mapping.classroom-teacher.index', compact('datas'));
    }

    public function editClassroomTeacher($id)
    {
        

        $class = Schoolclass::findOrFail($id);
        $teachers = Teacher::get();
        return view('admin.mapping.classroom-teacher.edit', compact('class', 'teachers'));
    }

    public function updateClassroomTeacher(Request $request, $id)
    {
       

        $class = Schoolclass::findOrFail($id);
        $class->teachers()->sync($request->teacher);
        return redirect()->back()->with('success', 'lol');
    }

    public function showClassroomCourse()
    {
        

        $datas = Schoolclass::orderBy('name')->paginate(10);
        return view('admin.mapping.classroom-course.index', compact('datas'));
    }

    public function editClassroomCourse($id)
    {
      

        $class = Schoolclass::findOrFail($id);
        $courses = Course::get();
        return view('admin.mapping.classroom-course.edit', compact('class', 'courses'));
    }

    public function updateClassroomCourse(Request $request, $id)
    {
        

        $class = Schoolclass::findOrFail($id);
        $class->courses()->sync($request->course);
        return redirect()->back()->with('success', 'lol');
    }

    public function showCourseTeacher()
    {
        

        $datas = Course::orderBy('name')->paginate(10);
        return view('admin.mapping.course-teacher.index', compact('datas'));
    }

    public function editCourseTeacher($id)
    {
        

        $course = Course::findOrFail($id);
        $teachers = Teacher::get();
        return view('admin.mapping.course-teacher.edit', compact('course', 'teachers'));
    }

    public function updateCourseTeacher(Request $request, $id)
    {
        

        $course = Course::findOrFail($id);
        $course->teachers()->sync($request->teacher);
        return redirect()->back()->with('success', 'lol');
    }
}
