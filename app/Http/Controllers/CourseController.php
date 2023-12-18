<?php

namespace App\Http\Controllers;

use App\Models\Teaches;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Tutor;
use App\Models\Subject;
use App\Models\Comment;
use App\Models\CourseRegister;
use DB;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    private $paginate =20;
    public function nouserCourseList(Request $request)
    {
       // dd($request->all());
        $subjectIds = $request->input('subject');
        $subjects = Subject::all();

        $coursesQuery = Course::where('course_status', 1);

        $courseLevels = $request->input('course_level');
        $query = $request->input('query');
        // มีการ search
        if ($query) {
            $coursesQuery->where('course_name', 'LIKE', "%$query%")
                ->orWhere('course_information', 'LIKE', "%$query%")
                ->where('course_status', 1);
        }
        // filtering
        if ($subjectIds) {
            $coursesQuery->whereIn('subject_id', $subjectIds);
        }

        if ($courseLevels) {
            $coursesQuery->whereIn('course_level', $courseLevels);
        }

        $courses = $coursesQuery->paginate(9);

        $teaches= Teaches::pluck( 'tutor_id','course_id')->toArray();
        $tutors = Tutor::pluck( 'tutor_name','id')->toArray();
      //  dd($tutors);
        return view('courses.nouser', compact('courses', 'subjects','teaches','tutors'));
    }

    // user courses
    public function CoursesList(Request $request)
    {
        $subjectIds = $request->input('subject');
        $subjects = Subject::all();

        $coursesQuery = Course::where('course_status', 1);

        $courseLevels = $request->input('course_level');
        $query = $request->input('query');
        // มีการ search
        if ($query) {
            $coursesQuery->where('course_name', 'LIKE', "%$query%")
                ->orWhere('course_information', 'LIKE', "%$query%")
                ->where('course_status', 1);
        }
        // filtering
        if ($subjectIds) {
            $coursesQuery->whereIn('subject_id', $subjectIds);
        }

        if ($courseLevels) {
            $coursesQuery->whereIn('course_level', $courseLevels);
        }

        $courses = $coursesQuery->paginate(9);
        $averageRatings = Comment::select('course_id', DB::raw('round(avg(rating), 2) as average_rating'))

            ->groupBy('course_id')
            ->get()
            ->pluck('average_rating', 'course_id');


        return view('courses.index', compact('courses', 'subjects', 'averageRatings'));
    }

    public function tutorCourseList(Request $request)
    {
        $subjectIds = $request->input('subject');
        $subjects = Subject::all();

        $coursesQuery = Course::where('course_status', 1);

        $courseLevels = $request->input('course_level');
        $query = $request->input('query');
        // มีการ search
        if ($query) {
            $coursesQuery->where('course_name', 'LIKE', "%$query%")
                ->orWhere('course_information', 'LIKE', "%$query%")
                ->where('course_status', 1);
        }
        // filtering
        if ($subjectIds) {
            $coursesQuery->whereIn('subject_id', $subjectIds);
        }

        if ($courseLevels) {
            $coursesQuery->whereIn('course_level', $courseLevels);
        }

        $courses = $coursesQuery->paginate(9);
        $averageRatings = Comment::select('course_id', DB::raw('round(avg(rating), 2) as average_rating'))

            ->groupBy('course_id')
            ->get()
            ->pluck('average_rating', 'course_id');
        return view('coursesTutor.index', compact('courses', 'subjects', 'averageRatings'));
    }

    // ----------------------------จัดการ courses ของฝั่ง tutor
    public function mycourses($id)
    {
        $tutors = Tutor::find($id);

        if (!$tutors) {
            return abort(404);
        }

        $tutors->load('courses');
        $courses = $tutors->courses()->paginate(9);

        $subjects = Subject::all();

        return view('coursesTutor.mycourses', compact('tutors', 'courses', 'subjects'));
    }


    public function mycoursesdetail($id)
    {
        $courses = Course::find($id);
        $subjects = Subject::all();
        $subject_id = $courses->subject_id;
        $subjectname = Subject::find($subject_id);

        if (!$courses) {
            return abort(404);
        }
        return view('coursesTutor.mycoursesdetail', compact('courses', 'subjects', 'subjectname'));

    }

    public function mycoursesdetailupdate(Request $request, $id)
    {
       // dd($request->all());
        $course_total_day =isset($request->course_total_day) ? $request->course_total_day : 0;
        $course_price       =isset($request->course_price) ? $request->course_price : 0;
        $courses = Course::findOrFail($id);
        $subjects = Subject::all();
        $subject_id = $courses->subject_id;
        $subjectname = Subject::find($subject_id);
        // Update course properties
        $request->validate([
            'course_name' => 'required|string',
            'subject_id' => 'required|integer',
            'course_information' => 'required|string',
            'course_content' => 'required|string',
            'course_time' => 'required|integer',
            'course_level' => 'required|string',
            'course_type' => 'required|array',
            'course_target' => 'required|string',
            'course_img' => 'image|mimes:jpeg,png,jpg,gif|max:5096',
            // Add image validation if needed
        ]);

        $courseOptions = $request->input('course_type');
        $courseOptionsString = '';
        $courseOptions = $request->input('course_type');
        if ($courseOptions) {
            $courseOptionsString = implode(',', $courseOptions);
        }
       // dd($courseOptionsString );
        $courses->course_name = $request->input('course_name');
        $courses->subject_id = $request->input('subject_id');
        $courses->course_information = $request->input('course_information');
        $courses->course_content = $request->input('course_content');
        $courses->course_time = $request->input('course_time');
        $courses->course_level = $request->input('course_level');
        $courses->course_type = $courseOptionsString;
        $courses->course_target = $request->input('course_target');
        $courses->course_total_day = $course_total_day;
        $courses->course_price = $course_price;

        if ($request->hasFile('course_img')) {
            $imagePath = $request->file('course_img')->store('courses', 'public');
            $courses->course_img = $imagePath;
        }

        $courses->save();

        return view('coursesTutor.mycoursesdetail', compact('courses', 'subjects', 'subjectname'));

    }

    public function addCourseForm()
    {
        return view('coursesTutor.add');
    }

    public function addCourse(Request $request)
    {

        $course_total_day =isset($request->course_total_day) ? $request->course_total_day : 0;
        $course_price =isset($request->course_price) ? $request->course_price : 0;

        $request->validate([
            'course_name' => 'required',
            'course_img' => 'required|image|mimes:jpg,jpeg,png,gif|max:5120',
            'subject_id' => 'required',
            'course_information' => 'required',
            'course_content' => 'required',
            'course_time' => 'required',
            'course_level' => 'required',
            // 'course_type' => 'required',
            'course_target' => 'required',

        ]);


        $imagePath = $request->file('course_img')->store('courses', 'public');

        $courseOptions = $request->input('course_type');

        $courseOptionsString = '';
        $courseOptions = $request->input('course_type');

        if ($courseOptions) {
            $courseOptionsString = implode(',', $courseOptions);
        }

        // $infotutor = new Te();

        $course = new Course();
        $course->course_img = $imagePath;
        $course->course_name = $request->course_name;
        $course->subject_id = $request->subject_id;
        $course->course_content = $request->course_content;
        $course->course_information = $request->course_information;
        $course->course_time = $request->course_time;
        $course->course_level = $request->course_level;
        $course->course_type = $courseOptionsString;
        $course->course_target = $request->course_target;
        $course->course_status = "0";
        $course->course_total_day =$course_total_day;
        $course->course_price = $course_price;

        $course->save();


        $teaches = new Teaches();
        $teaches->tutor_id = $request->tutor_id;
        $teaches->course_id = $course->id;
        $teaches->save();


        return redirect()->back()->with('success', 'เพิ่มคอร์สเรียนสำเร็จแล้ว.');
    }


    // ---------ดูรายละเอียดคอร์สเรียน---------------
    public function courseDetails($id)
    {
        $courses = Course::find($id);

        if (!$courses) {
            return abort(404);
        }

        return view('reviewsCourse.nouser', compact('courses'));
    }

    public function userCourseDetails($id)
    {
        $courses = Course::find($id);
        $user_id=  Auth::id();
        $tutors = Tutor::with('courses')->whereHas('courses', function ($query) use ($id) {
            $query->where('courses.id', $id);
        })->first();

        if (!$tutors) {
            return redirect()->back()->with('ไม่พบคอร์สนี้');
        }

        $tutor_courses = $tutors->courses;

        $comments = Comment::where('course_id', $id)
            ->orderBy('id', 'desc')->get();

        $RatingResults = number_format($comments->avg('rating'), 2);
        $CourseRegister =CourseRegister::where('user_id',$user_id)
        ->where('course_id',$id)->where('register_status','Y')->first();

        return view('reviewsCourse.index', compact('tutors', 'courses', 'tutor_courses', 'comments', 'RatingResults','CourseRegister'));
    }



    // public function tutorTutorDetails($id)
    // {
    //     $courses = Course::find($id);
    //     if (!$courses) {
    //         return abort(404);
    //     }
    //     $tutor_id= $courses->tutor_id;
    //     $tutors = Tutor::find($id);
    //     $courses = Course::where('tutor_id', $id)->paginate(9);
    //     $comments = Comment::where('course_id', $id)->orderBy('id','desc')->get();
    //     $RatingResults = number_format($comments->avg('rating'), 2);

    //     return view('reviewsCourse.tutor', compact('tutors', 'courses', 'comments', 'RatingResults'));
    // }

    public function tutorCourseDetails($id)
    {
        $courses = Course::find($id);

        $tutors = Tutor::with('courses')->whereHas('courses', function ($query) use ($id) {
            $query->where('courses.id', $id);
        })->first();

        if (!$tutors) {
            return redirect()->back()->with('ไม่พบคอร์สนี้');
        }

        $tutor_courses = $tutors->courses;

        $comments = Comment::where('course_id', $id)
            ->orderBy('id', 'desc')->get();

        $RatingResults = number_format($comments->avg('rating'), 2);


        return view('reviewsCourse.tutor', compact('courses', 'tutors', 'tutor_courses', 'comments', 'RatingResults'));
    }

    public function index()
    {
        $courses = Course::all();
        return view('coursesTutor.mycourses', compact('courses'));
    }


    // public function destroy(Request $request, $id)
    // {
    //     $courses = Course::find($id);

    //     if ($courses && $courses->user_id === auth()->user()->id) {

    //         $courses->delete();
    //         return redirect()->back()->with('success', 'Comment deleted successfully.');
    //     } else {

    //         return redirect()->back()->with('error', 'Not Comment deleted.');
    //     }
    // }

    public function delete(Course $course)
    {
        $course->delete();

        // Redirect to a page after deletion, for example, the course list page.
        return redirect()->back()->with('success', 'ลบคอร์สเรียนเรียบร้อย.');
    }

    public function mycoursesregister(Request $request,$courseid){
        $tutors = Tutor::find($courseid);

        if (!$tutors) {
            return abort(404);
        }

        $tutors->load('courses');
        $courses = $tutors->courses()->paginate(9);
        $subjects = Subject::all();

        $tutor_id = Auth::id();
        $CourseRegister =CourseRegister::where('tutor_id',$tutor_id)
        ->orderBy('doc_no')->paginate($this->paginate);
        $CoursTotal=CourseRegister::where('tutor_id',$tutor_id)->get();
        return view('coursesTutor.mycoursesregister', compact('CourseRegister','CoursTotal','tutors', 'courses', 'subjects'));
    }
}
