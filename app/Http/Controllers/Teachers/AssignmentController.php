<?php

namespace App\Http\Controllers\Teachers;

use DateTime;
use App\Models\Assignment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AssignmentRequest;

class AssignmentController extends Controller
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

        dd("index");
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

        return view('teacher.tasks.assignment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssignmentRequest $request)
    {
        //
        if (Gate::denies('manage-courses')) {
            abort(403);
        }
        
        $title_slug = Str::slug(request('title'));
        $datetime = new DateTime();

        $attachment = $request->file('path');
        $attach = null;
        if ($attachment !== null) {
            $attach = $attachment->storeAs("assignment", "{$title_slug}-{$datetime->format('Y-m-d-s')}.{$attachment->extension()}");
        }

        $assignment = Assignment::create([
            'schoolclass_id' => $request->classId,
            'subjectmatter_id' => $request->subject,
            'teacher_id' => Auth::user()->teachers[0]->id,
            'title' => $request->title,
            'instructions' => $request->instructions,
            'attachment' => 'public/' . $attach,
            'point' => $request->point,
            'due' => $request->due,
            'status' => $request->status
        ]);
        return redirect()->back()->with('success', 'lol');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idKelas, $id)
    {
        //
        if (Gate::denies('manage-courses')) {
            abort(403);
        }

        $ass = Assignment::findOrFail($id);

        return view('teacher.tasks.assignment.show', compact('ass', 'idKelas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($classId, $id)
    {
        if (Gate::denies('manage-courses')) {
            abort(403);
        }

        $status = ['Open', 'Close'];
        $point = [null => 'Ungraded', '100' => '100', '10' => '10'];

        $ass = Assignment::findOrFail($id);
        return view('teacher.tasks.assignment.edit', compact('ass', 'classId', 'status', 'point'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssignmentRequest $request, $id)
    {
        //
        if (Gate::denies('manage-courses')) {
            abort(403);
        }
        $title_slug = Str::slug(request('title'));
        $datetime = new DateTime();

        $ass = Assignment::findOrFail($id);

        $attachment = $request->file('path');
        $attach = null;
        if ($attachment !== null) {
            Storage::disk('local')->delete($ass->attachment);
            $attach = $attachment->storeAs("assignment", "{$title_slug}-{$datetime->format('Y-m-d-s')}.{$attachment->extension()}");
            $attach = 'public/' . $attach;
        } else {
            $attach = $ass->attachment;
        }

        $ass->update([
            'schoolclass_id' => $request->classId,
            'subjectmatter_id' => $request->subject,
            'teacher_id' => Auth::user()->teachers[0]->id,
            'title' => $request->title,
            'instructions' => $request->instructions,
            'attachment' => $attach,
            'point' => $request->point,
            'due' => $request->due,
            'status' => $request->status
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
        $ass = Assignment::findOrFail($id);
        $ass->delete();
        Storage::disk('local')->delete($ass->attachment);
        return redirect()->back()->with('success', 'lol');
    }
}
