<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\news;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Course;
use App\Models\Comment;
use App\Models\Subject;
use App\Models\Teaches;

use App\Models\UserMatch;
use Illuminate\Http\Request;
use App\Models\CourseRegister;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //  public function nouserhome()
    // {
    //     return view('layouts.nouserhome');
    // }

    // ---------------------user home ---------------------


    // public function index($userId)
    // {
    //     $news = news::all();
    //     $courses = Course::inRandomOrder()->limit(8)->get();
    //     $userMatch = UserMatch::where('user_id', $userId)->first();
    //     $tutors = Tutor::all();





    //     return view('layouts.navtest', compact('news', 'courses','tutors'));
    // }




    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        $users_count = User::where('is_admin', '0')->count();
        $admins_count = User::where('is_admin', '1')->count();
        $tutors_count = Tutor::where('is_tutor', '1')->count();
        // $comments = Comment::all();
        $averageRatings = Comment::select('tutor_id', DB::raw('avg(rating) as average_rating'))
            ->groupBy('tutor_id')
            ->orderBy('average_rating', 'desc')
            ->get();

        $news = news::all();
        $users = User::all();
        $tutors = Tutor::latest('created_at')->take(5)->get();
        $courses = Course::all();


        return view(
            'adminHome',
            compact(
                'users_count',
                'admins_count',
                'tutors_count',
                'users',
                'tutors',
                'courses',
                'news',
                'averageRatings',
            )
        );
    }

    public function tutorHome()
    {
        $this->updateExp();
        return view('tutorHome');
    }


    public function homereturn()
    {
        $this->updateExp();
        $userId = auth()->user()->id;
        return redirect()->route('home', compact('userId'));
    }

    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('nouserhome');
    }

    public function updateExp(){
        //dd('update EXP');
        $today = Carbon::now()->format('Y-m-d');
        CourseRegister::whereRaw(" (CURRENT_DATE()- date_start) >= course_total_day")
            ->where('course_total_day','>',0)
            ->where('approve_status','Y')
            ->update(['approve_status' => 'EXP']);
            return true;
    }

    public function index($userId)
    {

        $this->updateExp();


        $news = news::all();
        $courses = Course::inRandomOrder()->limit(8)->get();
        $tutors = Tutor::all();


        $userMatch = UserMatch::where('user_id', $userId)->firstOrFail();

        $subjectIds = explode(',', $userMatch->subject_id);
        $userStyle = explode(',', $userMatch->user_match_style);
        $userGender = explode(',', $userMatch->user_match_gender);
        $userLocate = $userMatch->user_match_province;
        $userLevel = explode(',', $userMatch->user_match_Edlevel);

        // dd($userLevel);
        // dd($userGender);

        // แปลง
        $userSubjectVector = $this->convertSubjectToVector($subjectIds);
        $userStyleVector = $this->convertStyleToVector($userStyle);
        $userGenderVector = $this->convertGenderToVector($userGender);
        $userLocateVector = $this->convertLocateToVector($userLocate);
        $userLevelVector = $this->convertLevelToVector($userLevel);

        // dd($userLevel,$userGender,$userLevelVector,$userGenderVector);
        // dd($userSubjectVector,$userStyleVector,$userLocateVector);

        $tutors = Tutor::all();
        $similarTutors = [];

        foreach ($tutors as $tutor) {

            $tutorVector = $this->convertSubjectToVector(explode(',', $tutor->courses->pluck('subject_id')->implode(',')));
            $tutorStyleVector = $this->convertStyleToVector(explode(',', $tutor->courses->pluck('course_type')->implode(',')));
            $tutorGenderVector = $this->convertGenderToVector($tutor->gender);
            $tutorLocateVector = $this->convertLocateToVector($tutor->tutor_address);
            $tutorLevelVector = $this->convertLevelToVector($tutor->courses->pluck('course_level')->implode(','));

            // dd($tutorLevelVector);

            $cosineSimilaritySubject = $this->calculateCosineSimilarityVector($userSubjectVector, $tutorVector);
            $cosineSimilarityStyle = $this->calculateCosineSimilarityVector($userStyleVector, $tutorStyleVector);
            $cosineSimilarityGender = $this->calculateCosineSimilarityVector($userGenderVector, $tutorGenderVector);
            $cosineSimilarityLocate = $this->calculateCosineSimilarityVector($userLocateVector, $tutorLocateVector);
            $cosineSimilarityLevel = $this->calculateCosineSimilarityVector($userLevelVector, $tutorLevelVector);

            // dd($cosineSimilarityStyle);

            $totalCosineSimilarity = (
                2 * $cosineSimilaritySubject +
                1 * $cosineSimilarityStyle +
                1 * $cosineSimilarityGender +
                3 * $cosineSimilarityLocate

            );

            // dd($totalCosineSimilarity);
            $similarTutors[] = [
                'tutor_id' => $tutor->id,
                'cosine_similarity' => $totalCosineSimilarity,
            ];

            // dd($tutor->id,$cosineSimilarity);
        }

        usort($similarTutors, function ($a, $b) {
            return $b['cosine_similarity'] <=> $a['cosine_similarity'];
        });
        $teachex= Teaches::pluck( 'tutor_id','course_id')->toArray();
        $tutorx = Tutor::pluck( 'tutor_name','id')->toArray();
        //dd($teachex);
        return view('layouts.navtest', compact('similarTutors', 'news', 'courses', 'tutors','teachex','tutorx'));

    }

    private function convertSubjectToVector($subjectIds)
    {
        $vector = [];
        $AllSubjects = [1, 2, 3, 4, 5, 6, 7];
        foreach ($AllSubjects as $AllSubject) {
            $vector[] = in_array($AllSubject, $subjectIds) ? 1 : 0;
        }
        // dd($vector);
        return $vector;
    }

    private function convertStyleToVector($Style)
    {
        $vector = [];
        $AllStyles = ['การสอนแบบตัวต่อตัว', 'การสอนแบบกลุ่ม'];

        foreach ($AllStyles as $AllStyle) {
            $vector[] = in_array($AllStyle, $Style) ? 1 : 0;
        }
        // dd($vector);
        return $vector;
    }

    private function convertGenderToVector($Gender)
    {
        $vector = [];
        $AllGenders = ['ผู้ชาย', 'ผู้หญิง'];

        foreach ($AllGenders as $AllGender) {
            $vector[] = $Gender === $AllGender ? 1 : 0;
        }
        // dd($vector);
        return $vector;
    }

    private function convertLocateToVector($Locate)
    {
        $vector = [];
        $AllLocates = [
            'กระบี่',
            'กรุงเทพมหานคร',
            'กาญจนบุรี',
            'กาฬสินธุ์',
            'กำแพงเพชร',
            'ขอนแก่น',
            'จันทบุรี',
            'ฉะเชิงเทรา',
            'ชลบุรี',
            'ชัยนาท',
            'ชัยภูมิ',
            'ชุมพร',
            'เชียงราย',
            'เชียงใหม่',
            'ตรัง',
            'ตราด',
            'ตาก',
            'นครนายก',
            'นครปฐม',
            'นครพนม',
            'นครราชสีมา',
            'นครศรีธรรมราช',
            'นครสวรรค์',
            'นนทบุรี',
            'นราธิวาส',
            'น่าน',
            'บึงกาฬ',
            'บุรีรัมย์',
            'ปทุมธานี',
            'ประจวบคีรีขันธ์',
            'ปราจีนบุรี',
            'ปัตตานี',
            'พระนครศรีอยุธยา',
            'พังงา',
            'พัทลุง',
            'พิจิตร',
            'พิษณุโลก',
            'เพชรบุรี',
            'เพชรบูรณ์',
            'แพร่',
            'พะเยา',
            'ภูเก็ต',
            'มหาสารคาม',
            'มุกดาหาร',
            'แม่ฮ่องสอน',
            'ยโสธร',
            'ยะลา',
            'ร้อยเอ็ด',
            'ระนอง',
            'ระยอง',
            'ราชบุรี',
            'ลพบุรี',
            'ลำปาง',
            'ลำพูน',
            'เลย',
            'ศรีสะเกษ',
            'สกลนคร',
            'สงขลา',
            'สตูล',
            'สมุทรปราการ',
            'สมุทรสงคราม',
            'สมุทรสาคร',
            'สระแก้ว',
            'สระบุรี',
            'สิงห์บุรี',
            'สุโขทัย',
            'สุพรรณบุรี',
            'สุราษฎร์ธานี',
            'สุรินทร์',
            'หนองคาย',
            'หนองบัวลำภู',
            'อ่างทอง',
            'อำนาจเจริญ',
            'อุดรธานี',
            'อุตรดิตถ์',
            'อุทัยธานี',
            'อุบลราชธานี',
            'อ่างทอง',
            'เชียงราย',
            'เชียงใหม่',
            'น่าน',
            'พะเยา',
            'แพร่',
            'แม่ฮ่องสอน',
            'ลำปาง',
            'ลำพูน',
            'อุตรดิตถ์'
        ];

        foreach ($AllLocates as $AllLocate) {
            $vector[] = $Locate === $AllLocate ? 1 : 0;
        }
        return $vector;
    }


    private function convertLevelToVector($Level)
    {
        $vector = [];
        $AllLevels = [
            "มัธยมศึกษาปีที่ 1",
            "มัธยมศึกษาปีที่ 2",
            "มัธยมศึกษาปีที่ 3",
            "มัธยมศึกษาปีที่ 4",
            "มัธยมศึกษาปีที่ 5",
            "มัธยมศึกษาปีที่ 6"
        ];
        foreach ($AllLevels as $AllLevel) {
            $vector[] = $Level === $AllLevel ? 1 : 0;
        }
        // dd($vector);
        return $vector;
    }

    private function calculateCosineSimilarityVector($vectorA, $vectorB)
    {
        $dotVectorAB = $sigmaA = $sigmaB = 0;


        foreach ($vectorA as $i => $value) {
            $dotVectorAB += $value * $vectorB[$i];
            $sigmaA += $value * $value;
            $sigmaB += $vectorB[$i] * $vectorB[$i];
        }

        if ($sigmaA != 0 && $sigmaB != 0) {
            $cosineSimilarity = $dotVectorAB / (sqrt($sigmaA) * sqrt($sigmaB));
        } else {
            $cosineSimilarity = 0;
        }

        return $cosineSimilarity;
    }
}
