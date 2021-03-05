<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\Subjectmatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\AssignmentRequest;

class AdminQuizController extends Controller
{
    //

    public function create()
    {
        //
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $subjects = Subjectmatter::get();
        return view('admin.tasks.quiz.create', compact('subjects'));
    }

    public function store(AssignmentRequest $request)
    {
        //
        if (Gate::denies('manage-users')) {
            abort(403);
        }
        $quiz = Quiz::create([
            'schoolclass_id' => $request->classId,
            'subjectmatter_id' => $request->subject,
            'admin_id' => Auth::user()->admins[0]->id,
            'title' => $request->title,
            'instructions' => $request->instructions,
            'point' => $request->point,
            'due' => $request->due,
        ]);
        return redirect()->back()->with('success', 'lol');
    }
}
