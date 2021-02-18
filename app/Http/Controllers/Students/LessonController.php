<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Schoolclass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Gate::denies('view-lessons')) {
            abort(403);
        }

        $getClassId = Auth::user()->students[0]->schoolclass_id;
        $class = Schoolclass::find($getClassId);
        return view('student.lessons.index', compact('class'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $subjectmatters = Course::find($id)->subjectmatters()->paginate(5);
        $courseid = 0;
        foreach ($subjectmatters as $subjectmatter) {
            $courseid = $subjectmatter->course_id;

        }
        // echo("ini subject matter course $lol1");
        if ($courseid === 0) {
            $count = 0;
            $course = Course::find($id)->name;
            return view('student.lessons.subject-list', compact('subjectmatters', 'count', 'course'));
        }
        $count = $subjectmatters->count();

        $getClassId = Auth::user()->students[0]->schoolclass_id;
        $class = Schoolclass::find($getClassId)->courses;

        for ($i=0; $i < $class->count(); $i++) { 
            # code...
            // echo($class[$i]->pivot);
            if ($courseid === $class[$i]->pivot->course_id) {
                $course = Course::find($id)->name;
                return view('student.lessons.subject-list', compact('subjectmatters', 'count', 'course'));
            }
        }
        
        
        abort(403, 'Nakal ya, bukan mapel kamu XD');
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
