<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Department;
use App\Models\Schoolclass;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Subjectmatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
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
        
        $datas = Teacher::orderBy('name')->paginate(10);
        return view('admin.users.teacher.index', compact('datas'));
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
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $teacher = Teacher::findOrFail($id);
        $genders = ['L' => 'Male', 'P' => 'Female'];

        return view('admin.users.teacher.edit', compact('teacher', 'genders'));
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
        $teacher = Teacher::findOrFail($id);
        $user = User::findOrFail($teacher->user_id);

        $name_slug = Str::slug(request('name'));
        $datetime = new DateTime();

        $picture = $request->file('pic');
        $pictureUrl = $teacher->user->profilepic;

        if ($picture !== null) {
            if ($pictureUrl !== null) {
                Storage::disk('local')->delete('public/' . $pictureUrl);
            }
            $pictureUrl = $picture->storeAs("images/profilepic", "{$name_slug}-{$datetime->format('Y-m-d-s')}.{$picture->extension()}");
        }

        $teacher->update([
            'nip' => $request->nip,     
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
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $teacher = Teacher::findOrFail($id);
        $user = User::findOrFail($teacher->user_id);
        
        if ($teacher->department !== null) {
            if ($teacher->department->id >= 1) {
                # code...
                $department = Department::findOrFail($teacher->department->id);
                $department->teacher_id = null;
                $department->save();
            }
        }
        
        if ($teacher->schoolclass !== null) {
            if ($teacher->schoolclass->id >= 1) {
                # code...
                $class = Schoolclass::findOrFail($teacher->schoolclass->id);
                $class->teacher_id = null;
                $class->save();
            }
        }

        if ($teacher->subjectmatters->count() >= 1) {
            # code...
            Subjectmatter::where('teacher_id', $teacher->id)->delete();
        }

        $teacher->courses()->detach();
        $teacher->schoolclasses()->detach();
        $teacher->delete();
        $user->delete();

        return redirect()->back()->with('success', 'lol');
    }
}
