<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class TutorAuthController extends Controller
{

    // protected $guard = 'tutor';
    // use AuthenticatesUsers;
    protected $redirectTo = '/';


    public function showLoginForm()
    {
        return view('auth.authtutor.tutorlogin');
    }

    public function showRegistrationForm()
    {
        return view('auth.authtutor.tutorregister');
    }

    public function __construct()
    {
        Auth::setDefaultDriver('tutor');
        config(['auth.defaults.passwords' => 'tutors']);


    }


    public function handleLogin(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::guard('tutor')->attempt($credentials)) {
            if (Auth::guard('tutor')->user()->is_tutor == 1) {
                return redirect()->intended(route('tutor.home'));
            }
            if (Auth::guard('tutor')->user()->is_tutor == 0) {
                return redirect()->back()->with('error', 'รอการอนุมัติ.');
            } else {
                return redirect()->back()->with('error', 'กรุณากรอกอีเมลล์และรหัสผ่านใหม่.');
            }
        } else {
            return redirect()->back()->with('error', 'กรุณากรอกอีเมลล์และรหัสผ่านใหม่.');
        }

    }


    // public function handleLogintest(Request $request)
    // {

    //     $credentials = $request->only('email', 'password');

    //     if (Auth::guard('web')->attempt($credentials)) {

    //         return redirect()->intended(route('tutor.home'));
    //     }
    //     return redirect()->back()->with('error', 'Invalid Credentials');
    // }


    public function logout(Request $request)
    {
        Auth::guard('tutor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}