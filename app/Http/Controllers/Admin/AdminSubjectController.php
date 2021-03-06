<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use App\Models\Teacher;
use App\Models\Schoolclass;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Subjectmatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SubjectMatterRequest;
use App\Models\Course;

class AdminSubjectController extends Controller
{
    public function __construct() {
        $this->middleware('role:admin');
    }
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       

        $classes = Schoolclass::get();
        
        return view('admin.manage-course.courses.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $courses = Course::get();
        return view('admin.manage-course.courses.create-subject', compact('courses'));
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
            'admin_id' => Auth::user()->admins[0]->id,
            'title' => $request->title,
            'details' => $request->details,
            'link' => 'https://www.youtube.com/embed/' . substr($request->link,32),
            'path' => 'public/' . $attach
        ]);
        return redirect()->back()->with('success', 'lol');
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
        return view('admin.manage-course.courses.course-list', compact('courses', 'class', 'idKelas'));
    }

    public function showSubject($id)
    {
        
        $datas = Subjectmatter::where('course_id', $id)->paginate(10);
        return view('admin.manage-course.courses.subject-table', compact('datas'));
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
        $courses = Course::get();
        return view('admin.manage-course.courses.edit-subject', compact('subject', 'courses'));
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
            'admin_id' => Auth::user()->admins[0]->id,
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
        return view('admin.manage-course.courses.show-subject', compact('subject', 'datas', 'downloads'));
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
