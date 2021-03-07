<?php

namespace App\Http\Controllers;

use App\Models\Schoolclass;
use Illuminate\Http\Request;

class ClassPeopleController extends Controller
{
    //
    public function admin($id)
    {
        $class = Schoolclass::find($id);
        return view('admin.manage-course.courses.people', compact('class'));
    }

    public function teacher($id)
    {
        $class = Schoolclass::find($id);
        return view('teacher.courses.people', compact('class'));
    }
}
