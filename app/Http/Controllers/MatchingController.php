<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\TutorMatch;
use App\Models\UserMatch;
use Illuminate\Http\Request;

class MatchingController extends Controller
{
    //
    public function userform()
    {
        return view('Matching.index');
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'subject_id' => 'required|array',
            'subject_id.*' => 'integer',
            'province' => 'required|string',
            'level' => 'required|array',
            'level.*' => 'string',
            'stlye' => 'required|array',
            'stlye.*' => 'string',
            'gender' => 'required|array',
            'gender.*' => 'string',

        ]);

        $userId = Auth()->user()->id;
         
        $usersMatch = new UserMatch();
        $usersMatch->user_id = $request->input('user_id');
        // $usersMatch->subject_id = $request->input('subject_id');
        $usersMatch->subject_id = implode(',', $request->input('subject_id'));
        $usersMatch->user_match_province = $request->input('province');
        $usersMatch->user_match_Edlevel = implode(',', $request->input('level'));
        $usersMatch->user_match_style = implode(',', $request->input('stlye'));
        $usersMatch->user_match_gender = implode(',', $request->input('gender'));
        $usersMatch->save();

        return redirect()->route('home', $userId);
    }


    public function tutorform()
    {
        return view('MatchingTutor.index');
    }

    public function tutorstore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'subject_id' => 'required|array',
            'subject_id.*' => 'integer',
            'province' => 'required|string',
            'level' => 'required|array',
            'level.*' => 'string',
            'stlye' => 'required|array',
            'stlye.*' => 'string',
            'gender' => 'required|array',
            'gender.*' => 'string',

        ]);

        // dd($request);

        $tutorsMatch = new TutorMatch();
        $tutorsMatch->tutor_id = $request->input('tutor_id');
        $tutorsMatch->subject_id = implode(',', $request->input('subject_id'));
        $tutorsMatch->tutor_match_province = $request->input('province');
        $tutorsMatch->tutor_match_Edlevel = implode(',', $request->input('level'));
        $tutorsMatch->tutor_match_style = implode(',', $request->input('stlye'));
        $tutorsMatch->tutor_match_gender = implode(',', $request->input('gender'));
        $tutorsMatch->save();

        
        return redirect('/tutor/home');
    }

}