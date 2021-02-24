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
        if (Gate::denies('manage-courses')) {
            abort(403);
        }

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
        if (Gate::denies('manage-courses')) {
            abort(403);
        }
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
        if (Gate::denies('manage-courses')) {
            abort(403);
        }
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
        if (Gate::denies('manage-courses')) {
            abort(403);
        }
        // $courses =  Teacher::find(Auth::user()->teachers[0]->id)->courses;
        $class = Schoolclass::find($id);
        $courses = Schoolclass::findOrFail($id)->courses;
        return view('teacher.courses.course-list', compact('courses', 'class'));
    }

    public function showSubject($id)
    {
        if (Gate::denies('manage-courses')) {
            abort(403);
        }
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
        if (Gate::denies('manage-courses')) {
            abort(403);
        }
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
        if (Gate::denies('manage-courses')) {
            abort(403);
        }
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
            'link' => $request->link,
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
        if (Gate::denies('manage-courses')) {
            abort(403);
        }
        $subject = Subjectmatter::findOrFail($id);
        $subject->delete();
        Storage::disk('local')->delete($subject->path);
        return redirect()->back()->with('success', 'lol');
    }
}
