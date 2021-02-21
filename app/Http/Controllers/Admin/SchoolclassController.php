<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Schoolclass;
use App\Models\Teacher;
use Illuminate\Support\Facades\Gate;

class SchoolclassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Gate::denies('manage-users')) {
            abort(403);
        }
        
        $datas = Schoolclass::orderBy('name')->paginate(10);
        return view('admin.schoolclasses.index', compact('datas'));
    }

    public function showClassroomTeacher()
    {
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $datas = Schoolclass::orderBy('name')->paginate(10);
        return view('admin.schoolclasses.map-teacher', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Gate::denies('manage-users')) {
            abort(403);
        }
        $teachers = Teacher::get();
        $departments = Department::get();
        return view('admin.schoolclasses.create', compact('teachers', 'departments'));
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
        if (Gate::denies('manage-users')) {
            abort(403);
        }

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

        return redirect(route('admin.schoolclasses.create'))->with('success', 'lol');
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
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $class = Schoolclass::findOrFail($id);
        $teachers = Teacher::get();
        $departments = Department::get();
        return view('admin.schoolclasses.edit', compact('class', 'teachers', 'departments'));
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
        if (Gate::denies('manage-users')) {
            abort(403);
        }

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
        if (Gate::denies('manage-users')) {
            abort(403);
        }
        $class = Schoolclass::findOrFail($id);
        $class->delete();

        return redirect()->back()->with('success', 'lol');
    }
}
