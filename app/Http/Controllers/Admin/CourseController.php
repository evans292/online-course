<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Schoolclass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    public function __construct() {
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        
        $datas = Course::orderBy('name')->paginate(10);
        return view('admin.courses.index', compact('datas'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        
        return view('admin.courses.create');
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
        

        $this->validate($request, [
            'name' => 'required',
            'information' => 'required'
        ]);

        Course::create([
            'name' => $request->name,
            'information' => $request->information
        ]);

        return redirect(route('admin.courses.create'))->with('success', 'lol');
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
        

        $course = Course::findOrFail($id);
        return view('admin.courses.edit', compact('course'));
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
        

        $this->validate($request, [
            'name' => 'required',
            'information' => 'required'
        ]);
        $course = Course::findOrFail($id);
        $course->update([
            'name' => $request->name,
            'information' => $request->information
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
        
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->back()->with('success', 'lol');
    }
}
