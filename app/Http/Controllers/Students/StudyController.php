<?php

namespace App\Http\Controllers\Students;

use App\Models\Course;
use App\Models\Schoolclass;
use App\Models\Subjectmatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class StudyController extends Controller
{
    //
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

    public function showSubject($id)
    {
        //
        if (Gate::denies('view-lessons')) {
            abort(403);
        }

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

    public function showSubjectDetails(Course $course, Subjectmatter $subject)
    {
        //
        if (Gate::denies('view-lessons')) {
            abort(403);
        }

        $getClassId = Auth::user()->students[0]->schoolclass_id;
        $class = Schoolclass::find($getClassId)->courses;
        for ($i=0; $i < $class->count(); $i++) { 
            # code...
            // echo($class[$i]->pivot);
            if ($course->id === $class[$i]->pivot->course_id) {
                return view('student.lessons.subject.show-subject', compact('subject'));
            }
        }
        abort(403, 'Dibilangin bukan mapel kamu T_T');
    }

    public function download(Course $course, Subjectmatter $subject)
    {
        if (Gate::denies('view-lessons')) {
            abort(403);
        }

        $getClassId = Auth::user()->students[0]->schoolclass_id;
        $class = Schoolclass::find($getClassId)->courses;
        for ($i=0; $i < $class->count(); $i++) { 
            # code...
            // echo($class[$i]->pivot);
            if ($course->id === $class[$i]->pivot->course_id) {
            try {
                    return Storage::disk('local')->download($subject->path);
                } catch (\Exception $e) {
                    abort(404, $e->getMessage());
                }
            }
        }
        abort(403, 'Bukan mapel kamu woi -_-');
    }
}
