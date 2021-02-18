<?php

namespace App\Http\Controllers\Teachers;

use DateTime;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SubjectMatterRequest;
use App\Models\{Teacher, Schoolclass, Subjectmatter};

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Gate::denies('manage-courses')) {
            abort(403);
        }

        $classes = Teacher::find(Auth::user()->teachers[0]->id)->schoolclasses;
        // dd($classes[2]->pivot->schoolclass_id);
        return view('teacher.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('teacher.courses.create');
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
        $attach = $attachment->storeAs("attachment", "{$title_slug}-{$datetime->format('Y-m-d-s')}.{$attachment->extension()}");

        $subject = Subjectmatter::create([
            'course_id' => $request->course,
            'teacher_id' => Auth::user()->teachers[0]->id,
            'title' => $request->title,
            'details' => $request->details,
            'link' => $request->link,
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
    public function show($id)
    {
        //
        $teachercourse =  Teacher::find(Auth::user()->teachers[0]->id)->courses;
        $courses = Schoolclass::find($id)->courses;
        return view('teacher.courses.course', compact('courses'));
    }

    public function showSubject($id)
    {
        $datas = Subjectmatter::where('course_id', $id)->paginate(10);
        for ($i=0; $i < $datas[0]->course->teachers->count(); $i++) { 
            # code...
            if ($datas[0]->course->teachers[$i]->id === Auth::user()->teachers[0]->id) {
                # code...
                return view('teacher.courses.subject', compact('datas'));
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
        $subject = Subjectmatter::find($id);
        $subject->delete();
        Storage::disk('local')->delete($subject->path);
        return redirect()->back()->with('success', 'lol');
    }
}
