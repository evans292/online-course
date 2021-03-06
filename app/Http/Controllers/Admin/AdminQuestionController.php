<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdminQuestionController extends Controller
{
    public function __construct() {
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $questions = Question::where('quiz_id', $request->segment(4))->paginate(5);
        $quiz = Quiz::findOrFail($request->segment(4));

        return view('admin.tasks.quiz.question.index', compact('questions', 'quiz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $classId, $quizId)
    {
        //
        $quiz = Quiz::findOrFail($request->segment(4));
        return view('admin.tasks.quiz.question.create', compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $classId, $quizId)
    {
        //
        $request->validate([
            'question' => 'required',
        ]);
        
        $optionArray = $request->input('option');
        $correctOptions = $request->input('correct');
            
        $question = new Question();
        $question->quiz_id = $quizId;
        $question->question = $request->question;
        $question->save();

        $questionToAdd = Question::latest()->first();
        $questionID = $questionToAdd->id;

        foreach ($optionArray as $index => $opt) {
            $option = new Option();
            $option->question_id = $questionID;
            $option->option = $opt;
            foreach ($correctOptions as $correctOption) {
                if($correctOption == $index+1) {
                    $option->correct = 1;
                }
            }

            $option->save();
        }

        return redirect()->back()->with('success', 'lol');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $classId, $quizId, $questionId)
    {
        //
        $question = Question::findorFail($questionId);
        $quiz = Quiz::findOrFail($request->segment(4));
    
        return view('admin.tasks.quiz.question.show', compact('question', 'quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $classId, $quizId, $questionId)
    {
        //
        $question = Question::findorFail($questionId);
        $quiz = Quiz::findOrFail($request->segment(4));
    
        return view('admin.tasks.quiz.question.edit', compact('question', 'quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $classId, $quizId, $questionId)
    {
        //
        $question = Question::findOrFail($questionId);
        $question->question = $request->question;
        $question->save();

        return redirect()->back()->with('success', 'lol');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($classId, $quizId, $questionId)
    {
        //
        $question = Question::findOrFail($questionId);
        $question->delete();

        return redirect()->back()->with('success', 'lol');
    }
}
