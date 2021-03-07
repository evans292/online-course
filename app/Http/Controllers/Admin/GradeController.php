<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Schoolclass;
use Illuminate\Support\Facades\Gate;

class GradeController extends Controller
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
        if (Gate::denies('manage-users')) {
            abort(403);
        }
        $class = Schoolclass::findOrFail($id);
        return view('admin.tasks.quiz-grade', compact('class'));
    }
}
