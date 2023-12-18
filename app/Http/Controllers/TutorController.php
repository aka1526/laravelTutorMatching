<?php

namespace App\Http\Controllers;

use App\Models\reviews;
use Illuminate\Http\Request;
use App\Models\Tutor;
use App\Models\news;
use App\Models\Course;
use App\Models\Comment;
use DB;

class TutorController extends Controller
{

    // --------------------------------------------------User------------------------------------

    //ยังไม่ login
    public function nouserShowTutor()
    {
        $news = news::all();
        $courses = Course::inRandomOrder()->limit(8)->get();
        $tutors = Tutor::inRandomOrder()->limit(8)->get();

        return view('layouts.nouserhome', compact('news', 'courses', 'tutors'));
    }

    //ยังไม่ login
    public function tutorsList(Request $request)
    {
        //dd($request->all());
        $search = $request->input('search');
        $selectedGenders = $request->input('gender');
      //  dd($selectedGenders );
        $comments = Comment::all();
        // $comments = Comment::where('tutor_id', $id)->get();

        if ($search) {
            $query = Tutor::where('tutor_firstname', 'LIKE', '%'.$search.'%')
                ->orWhere('tutor_lastname', 'LIKE','%'.$search.'%');
        } else {
            $query = Tutor::query();
        }
        if (!empty($selectedGenders)) {

            $query->whereIn('gender', $selectedGenders);
        }

        $tutors = $query->paginate(9);

        $averageRatings = Comment::select('tutor_id', DB::raw('round(avg(rating), 2) as average_rating'))
            ->groupBy('tutor_id')
            ->get()
            ->pluck('average_rating', 'tutor_id');


        return view('tutors.nouser', compact('tutors', 'averageRatings'));
    }

    //login แล้ว
    public function userTutorsList(Request $request)
    {
        $search = $request->input('search');
        $selectedGenders = $request->input('gender', []);

        if ($search) {
            $query = Tutor::where('tutor_firstname', 'LIKE', '%'.$search.'%')
                ->orWhere('tutor_lastname', 'LIKE','%'.$search.'%');
        } else {
            $query = Tutor::query();
        }
        if (!empty($selectedGenders)) {
            $query->whereIn('gender', $selectedGenders);
        }

        $tutors = $query->paginate(9);

        $averageRatings = Comment::select('tutor_id', DB::raw('round(avg(rating), 2) as average_rating'))
            ->groupBy('tutor_id')
            ->get()
            ->pluck('average_rating', 'tutor_id');

        return view('tutors.index', compact('tutors', 'averageRatings'));
    }

    public function tutorTutorsList(Request $request)
    {
        $search = $request->input('search');
        $selectedGenders = $request->input('gender', []);


        if ($search) {
            $query = Tutor::where('tutor_firstname', 'LIKE', "%$search%")
                ->orWhere('tutor_lastname', 'LIKE', "%$search%");
        } else {
            $query = Tutor::query();
        }
        if (!empty($selectedGenders)) {
            $query->whereIn('gender', $selectedGenders);
        }
        $tutors = $query->paginate(9);

        $averageRatings = Comment::select('tutor_id', DB::raw('round(avg(rating), 2) as average_rating'))
            ->groupBy('tutor_id')
            ->get()
            ->pluck('average_rating', 'tutor_id');


        return view('tutors.tutor', compact('tutors', 'averageRatings'));
    }


    //-------------------------------- หน้าแสดงประวัติติวเตอร์ ---------------------------------
    public function TutorDetails($id)
    {
        $tutors = Tutor::find($id);

        if (!$tutors) {
            return abort(404); // Tutor not found, return a 404 response
        }

        // $courses = Course::where('tutor_id', $id)->paginate(9);
        // $courses = Course::with('tutors')->find($id);

        $tutors->load('courses');
        $courses = $tutors->courses;

        $comments = Comment::where('tutor_id', $id)->get();
        $RatingResults = number_format($comments->avg('rating'), 2);


        return view('reviews.nouser', compact('tutors', 'courses', 'comments', 'RatingResults'));
    }

    public function userTutorDetails($id)
    {

        $tutors = Tutor::find($id);

        if (!$tutors) {
            return abort(404); // Tutor not found, return a 404 response
        }

        // $courses = Course::where('tutor_id', $id)->paginate(9);
        // $courses = Course::with('tutors')->find($id);

        $tutors->load('courses');
        $courses = $tutors->courses;
        // dd($courses);

        $comments = Comment::where('tutor_id', $id)->get();
        $RatingResults = number_format($comments->avg('rating'), 2);


        return view('reviews.index', compact('tutors', 'courses', 'comments', 'RatingResults'));
    }

    public function tutorTutorDetails($id)
    {
        $tutors = Tutor::find($id);

        if (!$tutors) {
            return abort(404); // Tutor not found, return a 404 response
        }

        // $courses = Course::where('tutor_id', $id)->paginate(9);
        // $courses = Course::with('tutors')->find($id);

        $tutors->load('courses');
        $courses = $tutors->courses;

        $comments = Comment::where('tutor_id', $id)->get();
        $RatingResults = number_format($comments->avg('rating'), 2);

        return view('reviews.tutor', compact('tutors', 'courses', 'comments', 'RatingResults'));
    }







    // --------------------------------------------------Admin------------------------------------
    public function index()
    {
        $tutors = Tutor::all();
        // dd($tutors);
        return view('tutor.index', compact('tutors'));
    }

    public function profile($id)
    {
        $tutors = Tutor::find($id);

        if (!$tutors) {
            return abort(404);
        }

        return view('profileTutor.profile', compact('tutors'));
    }

    public function uploadProfile(Request $request, $id)
    {
        $request->validate([
            'tutor_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:kilobytes',
        ]);
        $imagePath = $request->file('tutor_img')->store('tutors', 'public');
        auth()->guard('tutor')->user()->update([
            'tutor_img' => $imagePath,
        ]);

        return redirect()->route('tutor.profile', ['id' => auth()->guard('tutor')->user()->id])->with('success', 'อัพโหลดเสร็จสิ้น!');
    }

    public function editprofile(Request $request, $id)
    {


        $line_token=isset($request->line_token ) ? $request->line_token  : '';

       // dd($request->all());
        $request->validate([
            'tutor_name' => 'required',
            'tutor_firstname' => 'required',
            'tutor_lastname' => 'required',
            'tutor_email' => 'required|email',
            // 'tutor_address' => 'required',
            // 'tutor_tel' => 'required',
            // 'tutor_birthdate' => 'required|date',
            // Add more validation rules as needed
        ]);

        // Update the tutor's profile
        $tutor = Tutor::findOrFail($id);

        $tutor->tutor_name = $request->input('tutor_name');
        $tutor->tutor_firstname = $request->input('tutor_firstname');
        $tutor->tutor_lastname = $request->input('tutor_lastname');
        $tutor->email = $request->input('tutor_email');
        $tutor->tutor_address = $request->input('tutor_address');
        $tutor->tutor_tel = $request->input('tutor_tel');
        $tutor->tutor_birthdate = $request->input('tutor_birthdate');
        $tutor->line_token = $line_token;
        // Add other fields as needed

        // Save the changes
        $tutor->save();

        return redirect()->route('tutor.profile', ['id' => auth()->guard('tutor')->user()->id])->with('success', 'อัพโหลดเสร็จสิ้น!');
    }




    // public function EditProfile(Request $request, $id)
    // {
    //     return redirect()->route('tutor.profile', ['id' => auth()->guard('tutor')->user()->id])->with('success', 'อัพโหลดเสร็จสิ้น!');
    // }



    public function promote()
    {
        return view('promoteTutor.index');
    }

    public function course()
    {
        return view('coursesTutor.index');
    }






    // --------------old ver.--------------------
    public function edit(Tutor $tutor)
    {
        // dd($news);
        // return view('tutor.edit', compact('tutors'));
        $tutors = $tutor->id;

        $tutors = Tutor::find($tutors);
        // return $tutors;
        return view('tutor.edit', compact('tutors'));
    }

    //------------modal new ver.--------------------


    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'info_tutor_education' => 'required',
        //     'info_tutor_faculty' => 'required',
        //     'info_tutor_major' => 'required',
        //     'info_tutor_grade' => 'required',
        //     'info_tutor_univercity' => 'required',
        //     'info_tutor_location' => 'required',
        //     'info_tutor_exp' => 'required'
        // ]);

        $tutors = Tutor::find($id);
        $tutors->is_tutor = '1';
        $tutors->save();

        return redirect('/admin/tutors')->with('success', 'อนุมัติเสร็จสิ้น.');
    }



    public function destroy($id)
    {
        $record = Tutor::findOrFail($id);
        if ($record) {
            $record->delete();
            return redirect()->back()->with('success', 'ติวเตอร์ถูกลบออกแล้ว!.');
        }
        return redirect()->back()->with('error', 'ไม่สามารถลบได้!.');
    }

    // ---------------------------Tutor---------------------------//
    public function dashboard()
    {
        return view('tutorHome');
    }


    public function indexTutor()
    {
        $news = news::all();
        $courses = Course::inRandomOrder()->limit(8)->get();
        $tutors = Tutor::inRandomOrder()->limit(8)->get();
        return view('tutorHome', compact('news', 'courses', 'tutors'));





    }



}
