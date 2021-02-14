<?php

namespace App\Http\Controllers\User;

use DateTime;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\{User, Admin, Student, Teacher, Headmaster, Schoolclass};

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
        $name_slug = Str::slug(request('name'));
        $datetime = new DateTime();

        $picture = $request->file('pic');
        $pictureUrl = Auth::user()->profilepic;
        if ($picture !== null) {
            if (Auth::user()->profilepic !== null) {
                Storage::disk('local')->delete('public/' . Auth::user()->profilepic);
            }
            $pictureUrl = $picture->storeAs("images/profilepic", "{$name_slug}-{$datetime->format('Y-m-d-s')}.{$picture->extension()}");
        }
        $user = User::find($userid);
        if ($user->role_id === 1) {
            Admin::where('id', $profileid)->update([
                'name' => $request->name,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'address' => $request->address,
                'phone' => $request->phone
            ]);

            $user->name = $request->name;
            $user->profilepic = $pictureUrl;
            $user->save();
        } else if ($user->role_id === 2) {
            Student::where('id', $profileid)->update([
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
        } else if ($user->role_id === 3) {
            Teacher::where('id', $profileid)->update([
                'name' => $request->name,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'address' => $request->address,
                'phone' => $request->phone
            ]);

            $user->name = $request->name;
            $user->profilepic = $pictureUrl;
            $user->save();
        } else {
            Headmaster::where('id', $profileid)->update([
                'name' => $request->name,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'address' => $request->address,
                'phone' => $request->phone
            ]);

            $user->name = $request->name;
            $user->profilepic = $pictureUrl;
            $user->save();
        }
        
        return redirect(route('profile'))->with('success', 'lol');
    }
}
