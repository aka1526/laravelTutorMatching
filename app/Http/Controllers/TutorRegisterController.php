<?php

namespace App\Http\Controllers;


use App\Models\InfoTutor;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tutor;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TutorRegisterController extends Controller
{
    //
    use RegistersUsers;

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('tutor.login');
        }
    }
    protected $redirectTo = '/tutor/login';

    public function __construct()
    {
        $this->middleware('guest:tutor');
    }

    protected function guard()
    {
        return auth()->guard('tutor');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'tutor_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('tutors')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'gender' => ['required', Rule::in(['ผู้ชาย', 'ผู้หญิง', 'อื่นๆ'])],
            'tutor_birthdate' => ['required'],
            'tutor_firstname' => ['required'],
            'tutor_lastname' => ['required'],
            'file' => ['required', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'tutor_tel' => ['required', 'regex:/^[0-9]{10}$/'],
            'info_tutor_certi' => ['required', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'info_tutor_education' => ['required'],
            'info_tutor_univercity' => ['required'],
            'info_tutor_faculty' => ['required'],
            'info_tutor_major' => ['required'],
            'info_tutor_grade' => ['required'],
            'info_tutor_location' => ['required'],
            'info_tutor_exp' => ['required'],
        ]);


    }

    // ----------------------new one-------------------
    protected function create(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect(route('tutor.registerPage'))
                ->withErrors($validator)
                ->withInput();
        }

        $imagePath = $request->file('file')->store('tutors', 'public');
        $certiPath = $request->file('info_tutor_certi')->store('tutors', 'public');

        $tutor = Tutor::create([
            'tutor_name' => $request['tutor_name'],
            // 'tutor_img' => $imageProfile,
            'tutor_img' => "profile_images/usernew.png",
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'is_tutor' => '0',
            // 'gender' => 'ชาย',
            'gender' => $request['gender'],
            'tutor_birthdate' => $request['tutor_birthdate'],
            'tutor_firstname' => $request['tutor_firstname'],
            'tutor_lastname' => $request['tutor_lastname'],
            'file' => $imagePath,
            'tutor_tel' => $request['tutor_tel'],
        ]);


        $infotutor = new InfoTutor();
        $infotutor->tutor_id = $tutor->id;
        $infotutor->info_tutor_education = $request->info_tutor_education;
        $infotutor->info_tutor_univercity = $request->info_tutor_univercity;
        $infotutor->info_tutor_faculty = $request->info_tutor_faculty;
        $infotutor->info_tutor_major = $request->info_tutor_major;
        $infotutor->info_tutor_grade = $request->info_tutor_grade;
        $infotutor->info_tutor_location = $request->info_tutor_location;
        $infotutor->info_tutor_exp = $request->info_tutor_exp;
        $infotutor->info_tutor_certi = $certiPath;
        $infotutor->save();

        auth()->guard('tutor')->login($tutor);
        return redirect(route('tutor.login'))->with('status', 'ลงทะเบียนติวเตอร์และเข้าสู่ระบบเรียบร้อยแล้ว.');
    }




}