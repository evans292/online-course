<?php

namespace App\Http\Controllers\Teachers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\Subjectmatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AssignmentRequest;

class QuizController extends Controller
{
    //
    public function __construct() {
        $this->middleware('role:teacher');
    }
    public function create()
    {
        //
       

        $subjects = Subjectmatter::get();
        return view('teacher.tasks.quiz.create', compact('subjects'));
    }

    public function store(AssignmentRequest $request)
    {
        //
       
        $quiz = Quiz::create([
            'schoolclass_id' => $request->classId,
            'subjectmatter_id' => $request->subject,
            'teacher_id' => Auth::user()->teachers[0]->id,
            'title' => $request->title,
            'instructions' => $request->instructions,
            'point' => $request->point,
            'due' => $request->due,
        ]);
        return redirect()->back()->with('success', 'lol');
    }

    public function show($idKelas, $id)
    {
        //
       

        $quiz = Quiz::findOrFail($id);

        return view('teacher.tasks.quiz.show', compact('quiz', 'idKelas'));
    }

    public function edit($classId, $id)
    {
        

        $point = [null => 'Ungraded', '100' => '100', '10' => '10'];

        $quiz = Quiz::findOrFail($id);
        return view('teacher.tasks.quiz.edit', compact('quiz', 'classId', 'point'));
    }

    public function update(AssignmentRequest $request, $id)
    {
        //
        

        $quiz = Quiz::findOrFail($id);

        $quiz->update([
            'schoolclass_id' => $request->classId,
            'subjectmatter_id' => $request->subject,
            'teacher_id' => Auth::user()->teachers[0]->id,
            'title' => $request->title,
            'instructions' => $request->instructions,
            'point' => $request->point,
            'due' => $request->due,
        ]);

        return redirect()->back()->with('success', 'lol');
    }

    public function destroy($id)
    {
        //
        
        
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        Storage::disk('local')->delete($quiz->attachment);
        return redirect()->back()->with('success', 'lol');
    }
}
