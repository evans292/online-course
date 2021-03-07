<?php

namespace App\Http\Controllers\Admin;

use App\Models\Schoolclass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class GradeController extends Controller
{
    //
    public function show(Request $request, $id) 
    {
        if (Gate::denies('manage-users')) {
            abort(403);
        }
        $class = Schoolclass::findOrFail($id);
        return view('admin.tasks.quiz-grade', compact('class'));
    }

    public function pdf(Request $request, $id)
    {
        $class = Schoolclass::findOrFail($id);
        return view('admin.tasks.quiz-grade-pdf', compact('class'));
    }
}
