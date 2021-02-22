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
    public function showClassroomTeacher()
    {
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $datas = Schoolclass::orderBy('name')->paginate(10);
        return view('admin.mapping.classroom-teacher.index', compact('datas'));
    }

    public function editClassroomTeacher($id)
    {
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $class = Schoolclass::findOrFail($id);
        $teachers = Teacher::get();
        return view('admin.mapping.classroom-teacher.edit', compact('class', 'teachers'));
    }

    public function updateClassroomTeacher(Request $request, $id)
    {
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $class = Schoolclass::findOrFail($id);
        $class->teachers()->sync($request->teacher);
        return redirect()->back()->with('success', 'lol');
    }

    public function showClassroomCourse()
    {
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $datas = Schoolclass::orderBy('name')->paginate(10);
        return view('admin.mapping.classroom-course.index', compact('datas'));
    }

    public function editClassroomCourse($id)
    {
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $class = Schoolclass::findOrFail($id);
        $courses = Course::get();
        return view('admin.mapping.classroom-course.edit', compact('class', 'courses'));
    }

    public function updateClassroomCourse(Request $request, $id)
    {
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $class = Schoolclass::findOrFail($id);
        $class->courses()->sync($request->course);
        return redirect()->back()->with('success', 'lol');
    }

    public function showCourseTeacher()
    {
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $datas = Course::orderBy('name')->paginate(10);
        return view('admin.mapping.course-teacher.index', compact('datas'));
    }

    public function editCourseTeacher($id)
    {
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $course = Course::findOrFail($id);
        $teachers = Teacher::get();
        return view('admin.mapping.course-teacher.edit', compact('course', 'teachers'));
    }

    public function updateCourseTeacher(Request $request, $id)
    {
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $course = Course::findOrFail($id);
        $course->teachers()->sync($request->teacher);
        return redirect()->back()->with('success', 'lol');
    }
}
