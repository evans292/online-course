<?php

namespace App\Http\Controllers\Students;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Subjectmatter;
use App\Http\Controllers\Controller;

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
        return view('student.lessons.subject.show_subject', compact('subjectmatter'));
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
}
