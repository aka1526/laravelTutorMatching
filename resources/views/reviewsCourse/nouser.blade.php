<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TUTORMATCHING') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('css/courses/reviewCourse.css') }}">

    {{-- หน้า css หน้า home แบบ nouser --}}
    <link rel="stylesheet" href="{{ asset('css/tutors/tutorhome.css') }}">

    {{-- dropdown ตรง profile --}}
    <link rel="stylesheet" href="{{ asset('css/tutors/account.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-...." crossorigin="anonymous" />

    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet'>
    <title>Laravel</title>
    <style>
        .nav-link.btn.btn-danger {
            border-radius: 20px;
            color: whitesmoke;
            font-weight: bold;
        }

        #backbtn {
            text-decoration: none;
            color: rgb(233, 0, 0);
            font-size: 15px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <img src="{{ url('storage/img/11.png') }}" height="70" alt="" loading="lazy" />
            <a class="navbar-brand" href="{{ url('/') }}">TUTOR MATCHING</a>
            <button class="navbar-toggler ps-0" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon d-flex justify-content-start align-items-center">
                    <i class="fas fa-bars"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarExample01">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    {{-- <li class="nav-item" id="navlink1">
                        <a class="nav-link" href="{{ url('/tutor/login') }}">สำหรับติวเตอร์</a>
                    </li> --}}

                    <li class="nav-item" id="navlink1">
                        <a class="nav-link" href="{{ url('/tutor') }}">สำหรับติวเตอร์</a>
                    </li>
                    <li class="nav-item" id="navlink1">
                        <a class="nav-link" href="{{ url('/course') }}">คอร์สเรียน</a>
                    </li>
                    <li class="nav-item" id="navlink1">
                        <a class="nav-link" href="{{ url('/tutorsList') }}">ติวเตอร์</a>
                    </li>


                    {{-- <li class="nav-item" id="navlink1">
                        <a class="nav-link" href="#">แชท</a>
                    </li> --}}
                </ul>
                <ul class="navbar-nav mx-2  ">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a id="login_btn" class="nav-link btn btn-danger"
                                    href="{{ route('login') }}"><i class="fa fa-key"></i>  {{ __('เข้าสู่ระบบ') }} </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                <img src="{{ url("storage/{$user_img}") }}" width="45px" height="45px"
                                    alt="Profile Picture" class="profile-image rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end larger-dropdown" aria-labelledby="navbarDropdown">
                                <div class="container">
                                    <img src="{{ url("storage/{$user_img}") }}" width="45px" height="45px"
                                        alt="Profile Picture" class="profile-image rounded-circle">
                                    {{ Auth::user()->firstname }}
                                    {{ Auth::user()->lastname }}
                                </div>
                                <hr>
                                <a class="dropdown-item" href="{{ url('/profile', Auth::user()->id) }}">ตั้งค่าบัญชี</a>
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
        </div>
    </nav>

    <!-- ------------------------------------------------------------------------------------- -->


    <div class="container-port">
        <div class="mb-2">
            <a href="#" id="backbtn" class="btn btn-danger mt-auto mx-auto text-white" onclick="history.go(-1); return false;">
                <i class="fa-solid fa-arrow-left"></i> กลับไปหน้าที่แล้ว</a>
        </div>

        <h3 class="mb-4">รายละเอียดคอร์สเรียน</h3>

        <div class="row row-main">
            <div class="col-lg-5 col-md-12 col-sm-12 col1">
                <img src="{{ url("storage/{$courses->course_img}") }}" style="max-width: 95%;" height="250vh"
                    class="card-img-top" alt="Course Image">
                    <div class="button-container text-center mt-3" >

                        <a href="{{ route('reg.index',$courses->id) }}" class="btn btn-danger mt-auto mx-auto"><i class="fa fa-graduation-cap"></i> ลงทะเบียน</a>

                    </div>
            </div>
            <div class="col-lg-6">
                <div>
                    <h3><b>{{ $courses->course_name }}</b></h3>
                    {{ $courses->course_information }}
                </div>
                <div class="mt-3">
                    <b>{{ __('สอนโดย') }}</b>
                    @foreach ($courses->tutors as $tutor)
                        <div class="mt-2">
                            <img src="{{ url("storage/{$tutor->tutor_img}") }}" width="45px" height="45px"
                                alt="Profile Picture" class="profile-image rounded-circle">
                            {{ $tutor->tutor_firstname }} {{ $tutor->tutor_lastname }}
                        </div>
                    @endforeach

                </div>

                <div class="mt-3">
                    <b>{{ __('รายละเอียดการสอน') }}</b>
                    <div class="container" id="detailCourse">

                        <div id="item-1">
                            {{ __('รูปแบบการสอน :') }} {{ $courses->course_type }}
                        </div>
                        <div id="item-1">
                            {{ __('เป้าหมายการสอน :') }} {{ $courses->course_target }}
                        </div>
                        <div id="item-1">
                            {{ __('ระดับการสอน :') }} {{ $courses->course_level }}
                        </div>
                        <div id="item-1">
                          <h4>  {{ __('เวลาในการสอน :') }} {{ $courses->course_time }} {{ __('ชั่วโมง') }}</h4>
                        </div>

                        <div id="item-1">
                           <h3 class="text-danger"> {{ __('ค่าลงทะเบียน :') }} {{ number_format($courses->course_price,0) }} {{ __(' บาท') }}</h3>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <b>{{ __('เนื้อหาที่สอน') }}</b>
                    <div class="container" id="detailCourse">
                        <div id="item-1">
                            {{ $courses->course_content }}
                        </div>
                    </div>
                </div>
            </div>

        </div>





    </div>

    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2023 Tutor Matching. All rights reserved.</p>
    </footer>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>
