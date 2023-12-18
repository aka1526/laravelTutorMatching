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
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


class CourseRegisterController extends Controller
{
    protected  $userId ;
    protected $line_api="https://notify-api.line.me/api/notify";
    public function __construct(){
        $this->middleware(function ($request, $next) {

            try {
                if( Auth::check() || auth()->guard('tutor')->user()->id != null ){
                    $this->userId = Auth::id() !=''?  Auth::id() : auth()->guard('tutor')->user()->id;

                    return $next($request);
                }
     //code...
            } catch (\Throwable $th) {
                return redirect('/login');
            }

        });
    }
    public function index(Request $request,$courseid){
        $Teaches=Teaches::where('course_id',$courseid)->first();
        $tutor_id=$Teaches->tutor_id;
        $Tutor=Tutor::where('id',$tutor_id)->first();
        $Course=Course::where('id',$courseid)->first();
        $CountRegister=CourseRegister::where('course_id',$courseid)
        ->where('user_id',$this->userId)
        ->where('register_status','Y')->count();

         return view('courses.register.index',compact('Tutor','Course','CountRegister'));
    }

    public function save(Request $request ){
      //   dd($request->all());
         $act=false;
        $course_id=isset($request->course_id) ? $request->course_id : '';
        $date_start=isset($request->date_start) ? $request->date_start :null;
        $request->validate([
            'filepayment' => 'required|image|mimes:jpeg,png,jpg,gif|max:10048', // Adjust the validation rules as needed
        ]);
        $file = $request->file('filepayment');
        $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
        $payment_img= '/img/pay/'.$filename;

        $act=  $file->move(public_path('img/pay'), $filename);

      if($act){

        $Teaches=Teaches::where('course_id',$course_id)->first();
        $tutor_id=$Teaches->tutor_id;
        $Tutor=Tutor::where('id',$tutor_id)->first();
        $line_token= isset($Tutor->line_token) ? $Tutor->line_token : '';
        $Course=Course::where('id',$course_id)->first();

        $register_max = CourseRegister::where('register_month', date('m'))
        ->where('register_year', date('Y'))
        ->max('register_max');

        $no_max=$register_max>0 ? $register_max + 1 : 1;
        $doc_no = 'REG' . date('ym') . str_pad($no_max  , 3, '0', STR_PAD_LEFT);

        $register_date  =Carbon::now()->format("Y-m-d");
        $register_month =Carbon::now()->format("m");
        $register_year  =Carbon::now()->format("Y");
        $user_id        =Auth::id();
        $user = Auth::user();
        $user_name      = $user->name;
        $course_name    = $Course->course_name;
        $course_price   = $Course->course_price;
        $course_hour   = $Course->course_time;
        $course_total_day   = $Course->course_total_day;
        $tutor_name    =$Tutor->tutor_name;
        $payment_datetime   =Carbon::now()->format("Y-m-d H:i");
        $register_status="N";

         CourseRegister::insert([
            'doc_no' =>$doc_no
            ,'register_max'=>$no_max
            , 'register_date'=>$register_date
            , 'date_start'=>$date_start

            , 'register_month'=>$register_month
            , 'register_year'=>$register_year
            , 'user_id'=>$user_id
            , 'user_name'=>$user_name
            , 'course_id'=>$course_id
            , 'course_name'=>$course_name
            , 'tutor_id'=>$tutor_id
            , 'tutor_name'=>$tutor_name
            , 'course_price'=>$course_price
            , 'course_hour'=>$course_hour
            , 'course_total_day'=>$course_total_day
            , 'payment_img'=>$payment_img
            , 'register_status'=>$register_status
            , 'payment_datetime'=>$payment_datetime
       ]);
    }
    if($act){
        if($line_token){
            $this->lineNotifly( $line_token,$tutor_name,$doc_no,$user_name,$date_start);
        }

        $icon="success";
        $msg="ลงทะเบียนสำเร็จ";
        $result="success";
    } else {
        $icon="error";
        $msg="เกิดข้อผิดพลาด";
        $result="error";
    }

    //return response()->json(['result'=> $result,'icon'=>$icon,'msg'=> $msg],200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    return redirect()->back()->with('dataarray', ['result'=> $result,'icon'=>$icon,'msg'=> $msg,'reg_no'=>$doc_no]);

    }

    public function approve_docno(Request $request){
        //dd($request->all());
        $doc_no=isset($request->doc_no) ? $request->doc_no : '';
        $doc_status=isset($request->doc_status) ? $request->doc_status :'';
        $tutor_id =auth()->guard('tutor')->user()->id;

        $check = CourseRegister::where('doc_no',$doc_no)->where('tutor_id',$tutor_id)->count();
        $act=false;
        $register_status="N";
        if($doc_status=='Y'){
            $register_status="Y";
        }elseif($doc_status=='W' ){
            $register_status="N";
        }

        if($check ){
            $act=true;
            CourseRegister::where('doc_no',$doc_no)->where('tutor_id',$tutor_id)->update([
                'register_status'=>$register_status
                ,'approve_status'=>$doc_status
            ]);
        }

        if($act){
            $icon="success";
            $msg="บันทึกสำเสร็จ";
            $result="success";
        } else {
            $icon="error";
            $msg="เกิดข้อผิดพลาด";
            $result="error";
        }

        return response()->json(['result'=> $result,'icon'=>$icon,'msg'=> $msg],200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

    public function lineNotifly( $line_token,$tutor_name,$doc_no,$user_name,$date_start){

        $message = "\n เรียน :".$tutor_name;
        $message .= "\n มีผู้ลงทะเบียนใหม่";
        $message .= "\n RegNo:".$doc_no;
        $message .= "\n Name:".$user_name;
        $message .= "\n Data Start:".$date_start;


        $res = $this->notify_message($message,$line_token);

    }
    public function notify_message($message,$token){
    $queryData = array('message' => $message);
    $queryData = http_build_query($queryData,'','&');
    $headerOptions = array(
            'http'=>array(
                'method'=>'POST',
                'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                        ."Authorization: Bearer ".$token."\r\n"
                        ."Content-Length: ".strlen($queryData)."\r\n",
                'content' => $queryData
            ),
    );
    $context = stream_context_create($headerOptions);
    $result = file_get_contents($this->line_api,FALSE,$context);
    $res = json_decode($result);
    return $res;
    }
}
