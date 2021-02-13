<?php

namespace App\Http\Controllers\User;

use App\Models\{User, Admin, Student, Teacher, Headmaster, Schoolclass};
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function edit()
    {
        $data = null;
        if (Auth::user()->role_id === 1) {
            $data = Admin::find(Auth::user()->admins[0]->id);
        } else if (Auth::user()->role_id === 2) {
            $data = Student::find(Auth::user()->students[0]->id);
        } else if (Auth::user()->role_id === 3) {
            $data = Teacher::find(Auth::user()->teachers[0]->id);
        } else {
            $data = Headmaster::find(Auth::user()->headmasters[0]->id);
        }
        $genders = ['L' => 'Male', 'P' => 'Female'];
        $classes = Schoolclass::get();
        return view('user.profile', compact('data', 'genders', 'classes'));
    }

    public function update(UpdateProfileRequest $request, $userid, $profileid)
    {
        dd($userid);
        // $user = User::find($userid);
        // if ($user->role_id === 1) {
        //     Admin::where('id', $profileid)->update([
        //         'name' => $request->name,
        //         'birthdate' => $request->birthdate,
        //         'gender' => $request->gender,
        //         'address' => $request->address,
        //         'phone' => $request->phone
        //     ]);

        //     $user->name = $request->name;
        //     $user->save();
        // } else if ($user->role_id === 2) {
        //     Student::where('id', $profileid)->update([
        //         'name' => $request->name,
        //         'birthdate' => $request->birthdate,
        //         'gender' => $request->gender,
        //         'address' => $request->address,
        //         'phone' => $request->phone
        //     ]);

        //     $user->name = $request->name;
        //     $user->save();
        // } else if ($user->role_id === 3) {
        //     Teacher::where('id', $profileid)->update([
        //         'name' => $request->name,
        //         'birthdate' => $request->birthdate,
        //         'gender' => $request->gender,
        //         'address' => $request->address,
        //         'phone' => $request->phone
        //     ]);

        //     $user->name = $request->name;
        //     $user->save();
        // } else {
        //     Headmaster::where('id', $profileid)->update([
        //         'name' => $request->name,
        //         'birthdate' => $request->birthdate,
        //         'gender' => $request->gender,
        //         'address' => $request->address,
        //         'phone' => $request->phone
        //     ]);

        //     $user->name = $request->name;
        //     $user->save();
        // }
        
        // return redirect(route('profile'))->with('success', 'lol');
    }
}
