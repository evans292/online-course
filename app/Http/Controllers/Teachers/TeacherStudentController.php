<?php

namespace App\Http\Controllers\Teachers;

use DateTime;
use App\Models\User;
use App\Models\Student;
use App\Models\Schoolclass;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class TeacherStudentController extends Controller
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
 
        
        $datas = Student::orderBy('name')->paginate(10);
        return view('teacher.dashboard.student.index', compact('datas'));
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
 
        $student = Student::findOrFail($id);
        $genders = ['L' => 'Male', 'P' => 'Female'];
        $classes = Schoolclass::get();
        return view('teacher.dashboard.student.edit', compact('student', 'genders', 'classes'));
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
   
        $student = Student::findOrFail($id);
        $user = User::findOrFail($student->user_id);

        $name_slug = Str::slug(request('name'));
        $datetime = new DateTime();

        $picture = $request->file('pic');
        $pictureUrl = $student->user->profilepic;

        if ($picture !== null) {
            if ($pictureUrl !== null) {
                Storage::disk('local')->delete('public/' . $pictureUrl);
            }
            $pictureUrl = $picture->storeAs("images/profilepic", "{$name_slug}-{$datetime->format('Y-m-d-s')}.{$picture->extension()}");
        }

        $student->update([
            'nis' => $request->nis,
            'schoolclass_id' => $request->class,        
            'name' => $request->name,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        $user->name = $request->name;
        $user->profilepic = $pictureUrl;
        $user->save();

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

        $student = Student::findOrFail($id);
        $user = User::findOrFail($student->user_id);

        $student->delete();
        $user->delete();

        return redirect()->back()->with('success', 'lol');
    }
}
