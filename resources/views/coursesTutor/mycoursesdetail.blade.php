<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TUTOR-MATCHING</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/mycourses.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet'>
    {{-- <script src="{{ asset('js/tutors/hometutor.js') }}" defer></script> --}}


    <style>
        .container {
            background-color: whitesmoke;
        }

        #courseImg {
            max-width: 500px;
            max-height: 350px;
        }

        #container1 {
            border-radius: 20px;
        }
    </style>

</head>
@php
    $tutor_img = auth()
        ->guard('tutor')
        ->user()->tutor_img;
    // dd(auth()->guard('tutor')->user());
@endphp


<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <img src="{{ url('storage/img/11.png') }}" height="70" alt="" loading="lazy" id="img" />
            <a class="navbar-brand" href="{{ url('/tutor/home') }}" id="link">TUTOR MATCHING</a>
            <button class="navbar-toggler ps-0" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon d-flex justify-content-start align-items-center">
                    <i class="fas fa-bars"></i>
                </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarExample01">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item" id="navlink1">
                        <a class="nav-link" href="{{ url('/tutor/course') }}">คอร์สเรียน</a>
                    </li>
                    <li class="nav-item" id="navlink1">
                        <a class="nav-link" href="{{ url('/tutor/course') }}">ติวเตอร์</a>
                    </li>
                    <li class="nav-item" id="navlink1">
                        <a class="nav-link" href="#">แชท</a>
                    </li>
                    {{-- <li class="nav-item" id="navlink1">
                        <a class="nav-link" href="{{ url('/tutor/promoteTutor') }}">โปรโมต</a>
                    </li> --}}
                </ul>
                <ul class="navbar-nav mx-2  ">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                <img src="{{ url("storage/{$tutor_img}") }}" width="45px" height="45px"
                                    alt="Profile Picture" class="profile-image rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end larger-dropdown" aria-labelledby="navbarDropdown">
                                <div class="container">
                                    <img src="{{ url("storage/{$tutor_img}") }}" width="45px" height="45px"
                                        alt="Profile Picture" class="profile-image rounded-circle">
                                    {{ auth()->guard('tutor')->user()->tutor_firstname }}
                                    {{ auth()->guard('tutor')->user()->tutor_lastname }}
                                </div>
                                <hr>
                                <a class="dropdown-item"
                                    href="{{ url('tutor/mycourses',auth()->guard('tutor')->user()->id) }}">คอร์สของฉัน</a>
                                <a class="dropdown-item"
                                    href="{{ url('tutor/profile',auth()->guard('tutor')->user()->id) }}">ตั้งค่าบัญชี</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('ออกจากระบบ') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="sidebar">
        <ul class="sidebar-nav">
            <li><a href="{{ route('tutor.mycourse',auth()->guard('tutor')->user()->id) }}">คอร์สของฉัน</a></li>
            <li><a href="{{ route('tutor.mycourse.register',auth()->guard('tutor')->user()->id) }}">รายชื่อผู้ซื้อคอร์ส</a></li>
            <li><a href="{{ route('feedback', ['id' => auth()->guard('tutor')->user()->id]) }}">รีวิวผลตอบรับ</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="container" id="container1">
            <form method="POST" action="{{route('tutor.mycourse.update', $courses->id)}}" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4">
                        <img src="{{ url("storage/{$courses->course_img}") }}" class="card-img-top mt-4"
                            alt="Course Image" id="courseImg">
                        <input type="file" name="course_img" class="form-control"
                            value="{{ $courses->course_img }}">
                        @error('course_img')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <strong>ชื่อคอร์สเรียน</strong>
                            <input type="text" name="course_name" class="form-control" placeholder="ชื่อวิชา"
                                value="{{ $courses->course_name }}">
                            @error('course_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="option"><B>วิชา</B></label>
                            <select name="subject_id" id="option" class="form-control">
                                <option value="{{ $courses->subject_id }}">{{ $subjectname->subject_name }}</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">
                                        {{ $subject->subject_name }}</option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <strong>ข้อมูลวิชา</strong>
                        <div class="form-group my-2">
                            <textarea rows="4" cols="50" type="text" name="course_information" class="form-control"
                                placeholder="ข้อมูลวิชา">{{ $courses->course_information }}</textarea>
                            @error('course_information')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <textarea rows="4" cols="50" type="text" name="course_content" class="form-control"
                                placeholder="เนื้อหาที่สอน"> {{ $courses->course_content }} </textarea>
                            @error('course_content')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="form-group my-2">
                            <div class="row">
                                <div class="col-md-3 mt-2">
                                    <label for="course_time">จำนวนชั่วโมงที่สอน</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="course_time" class="form-control"
                                        placeholder="จำนวนชั่วโมงที่สอน" value="{{ $courses->course_time }}">
                                </div>
                                <div class="col-md-2 mt-2">
                                    <label for="course_time">ชั่วโมง</label>
                                </div>
                            </div>
                            @error('course_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <div class="row">
                            <div class="col-4">
                                <div class="form-control ">
                                    <label for="course_time">จำนวนชั่วโมงที่สอน </label>
                                    <input type="number" name="course_time" class="form-control" placeholder="จำนวนชั่วโมงที่สอน" value="{{ $courses->course_time }}" required>
                                    @error('course_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-control ">
                                    <label for="course_total_day">จำนวนวันหมดอายุ(วัน) </label>
                                    <input type="number" name="course_total_day" class="form-control" min="0" step="1" value="{{ $courses->course_total_day>0 ? $courses->course_total_day : 0 }}" placeholder="จำนวนวันหมดอายุ"  >
                                    @error('course_total_day')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-control ">
                                    <label for="course_price">ค่าลงทะเบียน</label>
                                    <input type="number" name="course_price" class="form-control" min="0" step="1"  value="{{ $courses->course_price > 0 ? $courses->course_price  : 0}}" placeholder="ค่าลงทะเบียน"  >
                                    @error('course_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <select name="course_level" class="form-control">
                            <option value="{{ $courses->course_level }}">{{ $courses->course_level }}</option>
                            <option value="มัธยมศึกษาตอนต้น">มัธยมศึกษาตอนต้น</option>
                            <option value="มัธยมศึกษาตอนปลาย">มัธยมศึกษาตอนปลาย</option>
                        </select>
                        @error('course_level')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <strong>รูปแบบการสอน</strong>
                        @php
                        $checksingle='';
                        $checkgroup=''; //"การสอนแบบตัวต่อตัว,การสอนแบบกลุ่ม"
                        $MethodsArray = explode(',', $courses->course_type);
                            foreach ($MethodsArray as $key => $chbox) {
                                    if( $chbox=="การสอนแบบตัวต่อตัว"){
                                        $checksingle='checked';
                                        break;
                                    }


                            }
                            foreach ($MethodsArray as $key => $chbox2) {

                                    if( $chbox2=="การสอนแบบกลุ่ม"){

                                        $checkgroup='checked';
                                        break;
                                    }

                            }
                        @endphp
                        <div class="form-group">
                            <label for="option1" class="form-check-label">
                                <input type="checkbox" id="option1" name="course_type[]" {{  $checksingle }}  value="การสอนแบบตัวต่อตัว" class="form-check-input">
                                การสอนแบบตัวต่อตัว
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="option2" class="form-check-label">
                                <input type="checkbox" id="option2" name="course_type[]" {{ $checkgroup }} value="การสอนแบบกลุ่ม"
                                    class="form-check-input"> การสอนแบบกลุ่ม
                            </label>
                        </div>

                        <strong>เป้าหมาย</strong>
                        <div class="col-md-6">
                            <div class="form-group my-2">
                                <textarea type="text" name="course_target" class="form-control"
                                    placeholder="เป้าหมายของวิชา เช่น การสอนเพื่อสอบเข้ามหาวิทบสลัย">{{ $courses->course_target }}</textarea>
                                @error('course_target')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="text">
                            <a href="{{route('tutor.mycourse',auth()->guard('tutor')->user()->id)}}" class="btn btn-warning">ย้อนกลับ</a>
                            <button type="submit" class="btn btn-success">ยืนยัน</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="{{ asset('js/tutors/hometutor.js') }}" defer></script>
</body>

</html>
