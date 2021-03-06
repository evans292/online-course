<?php

namespace App\Http\Controllers\Teachers;

use DateTime;
use App\Models\Course;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SubjectMatterRequest;
use App\Models\{Teacher, Schoolclass, Subjectmatter};

class SubjectController extends Controller
{
    public function __construct() {
        $this->middleware('role:teacher');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      

        $classes = Teacher::find(Auth::user()->teachers[0]->id)->schoolclasses;
        // dd($classes[2]->pivot->schoolclass_id);
        return view('teacher.courses.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
     
        return view('teacher.courses.create-subject');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectMatterRequest $request)
    {
        //
      
        $title_slug = Str::slug(request('title'));
        $datetime = new DateTime();

        $attachment = $request->file('path');
        $attach = null;

        if ($attachment !== null) {
            # code...
        $attach = $attachment->storeAs("attachment", "{$title_slug}-{$datetime->format('Y-m-d-s')}.{$attachment->extension()}");
        }

        $subject = Subjectmatter::create([
            'course_id' => $request->course,
            'teacher_id' => Auth::user()->teachers[0]->id,
            'title' => $request->title,
            'details' => $request->details,
            'link' => 'https://www.youtube.com/embed/' . substr($request->link,32),
            'path' => 'public/' . $attach
        ]);
        return redirect(route('teacher.courses.create'))->with('success', 'lol');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idKelas)
    {
        //
       
        // $courses =  Teacher::find(Auth::user()->teachers[0]->id)->courses;
        $class = Schoolclass::find($idKelas);
        $courses = Schoolclass::findOrFail($idKelas)->courses;
        return view('teacher.courses.course-list', compact('courses', 'class', 'idKelas'));
    }

    public function showSubject($id)
    {
        
        $datas = Subjectmatter::where('course_id', $id)->paginate(10);
        if ($datas->count() === 0) {
            # code...
            return view('teacher.courses.subject-table', compact('datas'));
        } else {
            for ($i=0; $i < $datas[0]->course->teachers->count(); $i++) { 
                # code...
                if ($datas[0]->course->teachers[$i]->id === Auth::user()->teachers[0]->id) {
                    # code...
                    return view('teacher.courses.subject-table', compact('datas'));
                }
            }
        }
        abort(403);
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
      
        $subject = Subjectmatter::findOrFail($id);
        return view('teacher.courses.edit-subject', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectMatterRequest $request, $id)
    {
        //
      
        $title_slug = Str::slug(request('title'));
        $datetime = new DateTime();

        $subject = Subjectmatter::findOrFail($id);

        $attachment = $request->file('path');
        $attach = null;
        if ($attachment !== null) {
            Storage::disk('local')->delete($subject->path);
            $attach = $attachment->storeAs("attachment", "{$title_slug}-{$datetime->format('Y-m-d-s')}.{$attachment->extension()}");
            $attach = 'public/' . $attach;
        } else {
            $attach = $subject->path;
        }

        $subject->update([
            'course_id' => $request->course,
            'teacher_id' => Auth::user()->teachers[0]->id,
            'title' => $request->title,
            'details' => $request->details,
            'link' => 'https://www.youtube.com/embed/' . substr($request->link,32),
            'path' => $attach
        ]);

        return redirect()->back()->with('success', 'lol');
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
       
        $subject = Subjectmatter::findOrFail($id);
        $subject->delete();
        Storage::disk('local')->delete($subject->path);
        return redirect()->back()->with('success', 'lol');
    }

    public function showSubjectDetails(Course $course, Subjectmatter $subject)
    {
        //
       
        $datas = $subject->subjectcounts()->paginate(5);
        $downloads = $subject->downloadsubjectcounts()->paginate(5);

        return view('teacher.courses.show-subject', compact('subject', 'datas', 'downloads'));
    }

    public function download(Course $course, Subjectmatter $subject)
    {
        
        try {
                return Storage::disk('local')->download($subject->path);
            } catch (\Exception $e) {
                abort(404, $e->getMessage());
            }
    }
}
