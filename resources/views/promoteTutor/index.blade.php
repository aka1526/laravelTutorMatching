<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TUTORMATCHING') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/tutorhome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/account.css') }}">
    <script src="{{ asset('js/tutors/hometutor.js') }}" defer></script>
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet'>
    <title>Laravel</title>

    <!-- fonts -->


    <!-- Styles -->
    <style>
        body {
            background-color: #eee;
        }

        /* --------------------------------------------------------------------------------- */
        * {
            margin: 0;
            padding: 0;
            font-family: "Kanit", sans-serif;
        }

        .col1 img {
            width: 20rem;
            margin: auto auto;
            display: block;
            border-radius: 10px;
        }

        .container-port {
            margin: 10%;
        }

        .col-6 h2 {
            margin-top: 5%;
            margin-bottom: 5%;
        }

        .container-port {
            margin-top: 100px;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            background-color: #fff;
        }

        /* Input styles */
        .form-control {
            border-radius: 10px;
        }

        /* Button styles */
        .btn-success {
            background-color: #1266f1;
            border: none;
            border-radius: 10px;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
            border-radius: 10px;
        }

        /* Add some margin to the text div */
        .text {
            margin-top: 20px;
        }

        .text-red {
            color: red;
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
            <img src="{{ url('storage/img/11.png') }}" height="70" alt="" loading="lazy" />
            <a class="navbar-brand" href="{{ url('/tutor/home') }}">TUTOR MATCHING</a>
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
                    <li class="nav-item" id="navlink1">
                        <a class="nav-link" href="{{ url('/tutor/promoteTutor') }}">โปรโมต</a>
                    </li>
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

    <!-- ------------------------------------------------------------------------------------- -->


    <!-- <div class="row text-center py-5">
        <div class="col-12 pb-2">
            <h2 class="text-red"><b>ขอการโปรโมต</b></h2>
        </div>
    </div> -->
    <div class="py-4">
        <div class="container-port">
            <div class="row text-center py-1">
                <div class="col-12 pb-2">
                    <h2 class="text-red"><b>ขอการโปรโมต</b></h2>
                </div>
            </div>

            <div class="row row-main">
                <strong>ข้อมูลการโปรโมต</strong>
                <div class="col-lg-5 col-md-12 col-sm-12 col1">
                    <strong>รูปวิชา</strong>

                    <input type="file" name="news_img" class="form-control" placeholder="รูปวิชา">
                    @error('news_img')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-12">
                    <div class="form-group my-2">
                        <strong></strong>
                        <textarea type="text" name="news_detail" class="form-control" placeholder="มหาวิทยาลัย"></textarea>
                        @error('news_detail')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group my-2">
                        <textarea type="text" name="news_detail" class="form-control" placeholder="การศึกษา"></textarea>
                        @error('news_detail')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group my-2">
                        <textarea type="text" name="news_detail" class="form-control" placeholder="เกรดเฉลี่ย"></textarea>
                        @error('news_detail')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- //////////////////////////////////////////////////////////////// -->

                <div class="col-md-6">
                    <div class="form-group my-2">
                        <textarea type="text" name="news_detail" class="form-control" placeholder="คณะการศึกษา"></textarea>
                        @error('news_detail')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group my-2">
                        <textarea type="text" name="news_detail" class="form-control" placeholder="สาขา"></textarea>
                        @error('news_detail')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- //////////////////////////////////////////////////////////////// -->

                <div class="col-md-6">
                    <div class="form-group my-2">
                        <textarea type="text" name="news_detail" class="form-control" placeholder="สถานที่สอน"></textarea>
                        @error('news_detail')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group my-2">
                        <textarea type="text" name="news_detail" class="form-control" placeholder="ประสบการณ์ในการสอน"></textarea>
                        @error('news_detail')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- //////////////////////////////////////////////// -->




            </div>



            <div class="row row-main">
                <strong>ระดับการศึกษา</strong>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">มัธยมศึกษาตอนต้น </label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">มัธยมศึกษาตอนปลาย</label>
                </div>
            </div>

            <div class="text"></div>
            <a href="{{ url('/tutor/courses') }}" class="btn btn-warning">ย้อนกลับ</a>
            <button type="submit" class="btn btn-success">ขอการโปรโมต</button>
        </div>
    </div>



    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2023 Tutor Matching. All rights reserved.</p>
    </footer>


    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>
