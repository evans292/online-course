<?php

namespace App\Http\Controllers\Admin;

use App\Models\Result;
use App\Models\Question;
use App\Models\UserOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->session()->forget('tes');
        $done = Result::where('quiz_id', $request->input('quiz_id'))->where('student_id', Auth::user()->students[0]->id)->first();
        if ($done === null) {
            $score = 0;
            $questions = $request->input('option');
    
            if ($questions) {
                foreach ($questions as $key => $value) {
                    $question = Question::find($key);
                    $userCorrectAnswers = 0;
                    foreach ($value as $answerKey => $answerValue) {
                        if ($answerValue == 1) {
                            $userCorrectAnswers++;
                        } else {
                            $userCorrectAnswers--;
                        }
                    }
                    if ($question->correctOptionsCount() == $userCorrectAnswers) {
                        $score++;
                    }
                }
                $result = new Result();
                $result->student_id = Auth::user()->students[0]->id;
                $result->quiz_id = $request->input('quiz_id');
                $result->correct_answer = $score;
                $result->questions_count = count($request->input('question_id'));
                $result->grade = round(($score / count($request->input('question_id'))) * 100);
                $result->save();
    
                foreach ($questions as $key => $value) {
                    foreach ($value as $answerKey => $answerValue) {
                        $userOption = new UserOption();
                        $userOption->student_id = Auth::user()->students[0]->id;
                        $userOption->result_id = $result->id;
                        $userOption->question_id = $key;
                        $userOption->quiz_id = $request->input('quiz_id');
                        $userOption->option_id = $answerKey;
                        $userOption->save();
                    }
                }
    
                return redirect(route('results.show', ['result' => $result->quiz_id, 'student' => Auth::user()->students[0]->id]));
            } else {
                return redirect()->back();
            }
        } else {
            abort(403, 'kamu udah pernah ngerjain yah? nakal');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($quizId, $studentId)
    {
        //
        if ($studentId != Auth::user()->students[0]->id) {
            abort(403, 'hayo ngapain liat nilai orang');
        }
        $result = Result::where('quiz_id', $quizId)->where('student_id', $studentId)->first();
        return view('results.show', compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
