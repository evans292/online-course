<?php

namespace App\Http\Controllers\Students;

use App\Models\Course;
use App\Models\Schoolclass;
use Illuminate\Http\Request;
use App\Models\Subjectmatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubjectController extends Controller
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subjectmatter  $subjectmatter
     * @return \Illuminate\Http\Response
     */
    public function show(Course $lesson, Subjectmatter $subjectmatter)
    {
        //
        $getClassId = Auth::user()->students[0]->schoolclass_id;
        $class = Schoolclass::find($getClassId)->courses;
        for ($i=0; $i < $class->count(); $i++) { 
            # code...
            // echo($class[$i]->pivot);
            if ($lesson->id === $class[$i]->pivot->course_id) {
                return view('student.lessons.subject.show-subject', compact('subjectmatter'));
            }
        }
        abort(403, 'Dibilangin bukan mapel kamu T_T');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subjectmatter  $subjectmatter
     * @return \Illuminate\Http\Response
     */
    public function edit(Subjectmatter $subjectmatter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subjectmatter  $subjectmatter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subjectmatter $subjectmatter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subjectmatter  $subjectmatter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subjectmatter $subjectmatter)
    {
        //
    }

    public function download(Course $lesson, Subjectmatter  $subjectmatter)
    {
        $getClassId = Auth::user()->students[0]->schoolclass_id;
        $class = Schoolclass::find($getClassId)->courses;
        for ($i=0; $i < $class->count(); $i++) { 
            # code...
            // echo($class[$i]->pivot);
            if ($lesson->id === $class[$i]->pivot->course_id) {
            try {
                    return Storage::disk('local')->download($subjectmatter->path);
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
            }
        }
        abort(403, 'Bukan mapel kamu woi -_-');
    }
}
