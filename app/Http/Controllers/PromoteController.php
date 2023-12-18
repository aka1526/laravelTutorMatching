<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promote;
use App\Models\Course;
use App\Models\Tutor;

class PromoteController extends Controller
{
    //
    public function index()
    {
        $courses = Course::with('tutors')->get();
        // dd($courses);
        return view('promotes.index', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'promote_id' => 'required',
            'tutor_id' => 'required',
            'admin_id' => 'required',
            'promote_title' => 'required',
            'promote_date' => 'required'
        ]);

        $promotes = new Promote;
        $promotes->promote_id = $request->promote_id;
        $promotes->tutor_id = $request->tutor_id;
        $promotes->promote_title = $request->promote_title;
        $promotes->promote_date = $request->promote_date;
        $promotes->save();
        return redirect()->route('promotes.index')->with('promotes', 'promotes has been created successfully.');
    }


    public function CoursesEdit($id)
    {
        $courses = Course::find($id);

        return view('promotes.edit', compact('courses'));
    }


    public function CoursesUpdate($id)
    {
        $courses = Course::find($id);
        $courses->course_status = '1';
        $courses->save();

        return redirect()->route('courses.index')->with('success', 'อนุมัติคอร์สเรียนเรียบร้อยแล้ว.');
    }

    public function destroy($id)
    {
        $courses = Course::find($id);

        if ($courses) {
            $courses->delete();
            return redirect()->route('courses.index')->with('success', 'ลบคอร์สเรียนเรียบร้อยแล้ว.');
        } else {
            return redirect()->route('courses.index')->with('error', 'Record not found.');
        }
    }



}