<?php

namespace App\Http\Controllers;


use App\Models\Tutor;
use App\Models\UserMatch;


use Illuminate\Http\Request;

class recommendController extends Controller
{
    public function calculateCosineSimilarity($userId)
    {

        $userMatch = UserMatch::where('user_id', $userId)->firstOrFail();

        $subjectIds = explode(',', $userMatch->subject_id);
        $userStyle = explode(',', $userMatch->user_match_style);
        $userGender = explode(',', $userMatch->user_match_gender);
        $userLocate = $userMatch->user_match_province;
        $userLevel = explode(',', $userMatch->user_match_Edlevel);

        dd($userStyle);
        $userSubjectVector = $this->convertSubjectToVector($subjectIds);
        $userStyleVector = $this->convertStyleToVector($userStyle);
        $userGenderVector = $this->convertGenderToVector($userGender);
        $userLocateVector = $this->convertLocateToVector($userLocate);
        $userLevelVector = $this->convertLevelToVector($userLevel);

        // dd($userLevelVector,$userGenderVector);
        // dd($userSubjectVector,$userStyleVector,$userLocateVector);

        $tutors = Tutor::all();

        // dd($tutors);

        $similarTutors = [];

        foreach ($tutors as $tutor) {

            $tutorVector = $this->convertSubjectToVector(explode(',', $tutor->courses->pluck('subject_id')->implode(',')));
            $tutorStyleVector = $this->convertStyleToVector(explode(',', $tutor->courses->pluck('course_type')->implode(',')));
            $tutorGenderVector = $this->convertGenderToVector($tutor->gender);
            $tutorLocateVector = $this->convertLocateToVector($tutor->tutor_address);
            $tutorLevelVector = $this->convertLevelToVector($tutor->courses->pluck('course_level')->implode(','));

            // dd($tutor->courses->pluck('course_level'));
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
                'cosine_similarity' => $totalCosineSimilarity
            ];

            // dd($tutor->id,$cosineSimilarity);
        }

        return view('test1', compact('similarTutors'));
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
        $possibleGenders = ['ผู้ชาย', 'ผู้หญิง'];

        foreach ($possibleGenders as $possibleGender) {
            $vector[] = $Gender === $possibleGender ? 1 : 0;
        }

        // dd($vector);
        return $vector;
    }

    private function convertLocateToVector($Locate)
    {
        $vector = [];
        $possibleLocates = [
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

        foreach ($possibleLocates as $possibleLocate) {
            $vector[] = $Locate === $possibleLocate ? 1 : 0;
        }

        return $vector;
    }


    private function convertLevelToVector($Level)
    {
        $vector = [];
        $possibleLevels = [
            "มัธยมศึกษาปีที่ 1",
            "มัธยมศึกษาปีที่ 2",
            "มัธยมศึกษาปีที่ 3",
            "มัธยมศึกษาปีที่ 4",
            "มัธยมศึกษาปีที่ 5",
            "มัธยมศึกษาปีที่ 6"
        ];

        foreach ($possibleLevels as $possibleLevel) {
            $vector[] = $Level === $possibleLevel ? 1 : 0;
        }

        // dd($vector);
        return $vector;
    }

    private function calculateCosineSimilarityVector($vectorA, $vectorB)
    {
        $dotVector = $sigmaA = $sigmaB = 0;

        foreach ($vectorA as $i => $value) {
            $dotVector += $value * $vectorB[$i];
            $sigmaA += $value ** 2;
            $sigmaB += $vectorB[$i] ** 2;
        }

        $sigmaA = sqrt($sigmaA);
        $sigmaB = sqrt($sigmaB);

        if ($sigmaA != 0 && $sigmaB != 0) {
            $cosineSimilarity = $dotVector / ($sigmaA * $sigmaB);
        } else {
            $cosineSimilarity = 0;
        }


        return $cosineSimilarity;
    }

}

