<?php

namespace App\Http\Controllers\Students;

use DateTime;
use App\Models\Course;
use App\Models\Assignment;
use App\Models\Schoolclass;
use Illuminate\Support\Str;

use App\Models\Accumulation;
use Illuminate\Http\Request;
use App\Models\Subjectmatter;
use App\Http\Controllers\Controller;
use App\Models\Subjectcount;
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

        // ambil id kelas punya siswa yang sedang login
        $getClassId = Auth::user()->students[0]->schoolclass_id;

        // lalu cari kelas berdasarkan id kelas siswa
        $class = Schoolclass::find($getClassId);
        return view('student.lessons.index', compact('class'));
    }

    public function showSubject($id)
    {
        //
        if (Gate::denies('view-lessons')) {
            abort(403);
        }

        $subjectmatters = Course::findOrFail($id)->subjectmatters()->paginate(5);
        $courseid = 0;
        foreach ($subjectmatters as $subjectmatter) {
            $courseid = $subjectmatter->course_id;

        }
        // echo("ini subject matter course $lol1");
        if ($courseid === 0) {
            $count = 0;
            $course = Course::findOrFail($id)->name;
            return view('student.lessons.subject-list', compact('subjectmatters', 'count', 'course'));
        }
        $count = $subjectmatters->count();

        $getClassId = Auth::user()->students[0]->schoolclass_id;
        $class = Schoolclass::findOrFail($getClassId)->courses;

        for ($i=0; $i < $class->count(); $i++) { 
            # code...
            // echo($class[$i]->pivot);
            if ($courseid === $class[$i]->pivot->course_id) {
                $course = Course::findOrFail($id)->name;
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
        // dd(Auth::user()->students[0]->id);
        // dd($subject->id);
        $count = Subjectcount::where('student_id', Auth::user()->students[0]->id)
        ->where('subjectmatter_id', $subject->id)
        ->first();

        if ($count !== null) {
            $count->increment('views');
        } else {
            $count = Subjectcount::create([
                'student_id' => Auth::user()->students[0]->id,
                'subjectmatter_id' => $subject->id,
                'views' => 1
            ]);
        }
    
        $getClassId = Auth::user()->students[0]->schoolclass_id;
        $class = Schoolclass::findOrFail($getClassId)->courses;
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
        $class = Schoolclass::findOrFail($getClassId)->courses;
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

    public function showAssignment(Request $request)
    {
        if (Gate::denies('view-lessons')) {
            abort(403);
        }

        $datas = Assignment::where('subjectmatter_id', $request->segment(5))->latest()->paginate(5);
        return view('student.assignment.index', compact('datas'));
    }

    public function showAssignmentDetails($courseId, $subjectId, $id)
    {
        //
        if (Gate::denies('view-lessons')) {
            abort(403);
        }

        $ass = Assignment::findOrFail($id);
        // $acc = $ass->accumulations->where('student_id', '===', Auth::user()->students[0]->id);
        $acc = Accumulation::where('assignment_id', $id)->where('student_id', Auth::user()->students[0]->id)->get();

        return view('student.assignment.show', compact('ass', 'acc'));
    }

    public function downloadAssignment($courseId, $subjectId, $assId)
    {
        //
        if (Gate::denies('view-lessons')) {
            abort(403);
        }

        $ass = Assignment::findOrFail($assId);
        try {
            return Storage::disk('local')->download($ass->attachment);
        } catch (\Exception $e) {
            abort(404, $e->getMessage());
        }
    }

    public function storeAccumulation(Request $request, $courseId, $subjectId, $assignmentId)
    {
        if (Gate::denies('view-lessons')) {
            abort(403);
        }
        
        $title_slug = Str::slug(Auth::user()->students[0]->name);
        $datetime = new DateTime();

        $attachment = $request->file('attachment');

        $attach = null;
        if ($attachment !== null) {
            $attach = $attachment->storeAs("accumulation", "{$title_slug}-{$datetime->format('Y-m-d-s')}.{$attachment->extension()}");
        }

        $request->validate([
            'attachment' => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpeg,png,jpg,mp3,aac',
        ]);

        $accumulation = Accumulation::create([
            'student_id' => Auth::user()->students[0]->id,
            'assignment_id' => $assignmentId,
            'subjectmatter_id' => $subjectId,
            'attachment' => 'public/' . $attach,
        ]);
        return redirect()->back()->with('success', 'lol');
    }

    public function deleteAccumulation($courseId, $subjectId, $assignmentId, $attachmentId)
    {
        if (Gate::denies('view-lessons')) {
            abort(403);
        }
        $acc = Accumulation::findOrFail($attachmentId);

        $acc->delete();
        Storage::disk('local')->delete($acc->attachment);
        return redirect()->back()->with('destroy', 'lol');
    }
}
