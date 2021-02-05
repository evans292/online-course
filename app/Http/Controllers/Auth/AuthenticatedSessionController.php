<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    public function loginTeacher()
    {
        return view('auth.login-teacher');
    }

    public function loginAdmin()
    {
        return view('auth.login-admin');
    }

    public function loginStudent()
    {
        return view('auth.login-student');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        if ($request->role === 'student') {
            return redirect(RouteServiceProvider::HOME)->with('student', $request->role);
        } else if ($request->role === 'teacher') {
            return redirect(RouteServiceProvider::HOME)->with('teacher', $request->role);
        } else if ($request->role === 'headmaster') {
            return redirect(RouteServiceProvider::HOME)->with('headmaster', $request->role);
        } else if ($request->role === 'admin'){
            return redirect(RouteServiceProvider::HOME)->with('admin', $request->role);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
