<?php

namespace App\Http\Controllers\Teachers;

use App\Models\Teacher;
use App\Models\Department;
use App\Models\Schoolclass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class TeacherSchoolclassController extends Controller
{
    public function __construct() {
        $this->middleware('role:teacher');
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

        
        $datas = Schoolclass::orderBy('name')->paginate(10);
        return view('teacher.dashboard.schoolclasses.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $teachers = Teacher::get();
        $departments = Department::get();
        return view('teacher.dashboard.schoolclasses.create', compact('teachers', 'departments'));
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

        Schoolclass::create([
            'teacher_id' => $request->chief,
            'department_id' => $request->department,
            'name' => $request->name,
            'information' => $request->information
        ]);

        return redirect()->back()->with('success', 'lol');
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


        $class = Schoolclass::findOrFail($id);
        $teachers = Teacher::get();
        $departments = Department::get();
        return view('teacher.dashboard.schoolclasses.edit', compact('class', 'teachers', 'departments'));
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

        $class = Schoolclass::findOrFail($id);
        $class->update([
            'teacher_id' => $request->chief,
            'department_id' => $request->department,
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

        $class = Schoolclass::findOrFail($id);
        $class->delete();

        return redirect()->back()->with('success', 'lol');
    }
}
