<?php

namespace App\Http\Controllers\Teachers;

use App\Models\Schoolclass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class TeacherGradeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        //
        if (Gate::denies('manage-courses')) {
            abort(403);
        }
        $class = Schoolclass::findOrFail($id);
        return view('teacher.tasks.quiz-grade', compact('class'));
    }
}
