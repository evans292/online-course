<?php

namespace App\Http\Controllers\Headmaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Downloadsubjectcount;
use App\Models\Subjectcount;
use App\Models\Subjectmatter;
use App\Models\Teacher;
use Illuminate\Support\Facades\Gate;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Gate::allows('view-lessons')) {
            abort(403);
        }

        $subjects = Subjectmatter::paginate(5);
        $teachers = Teacher::paginate(5);
        $admins = Admin::paginate(5);
        $subjectcount = Subjectcount::paginate(5);
        $downloadcount = Downloadsubjectcount::paginate(5);
        return view('headmaster.data.index', compact('admins','subjects', 'teachers', 'subjectcount', 'downloadcount'));
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
