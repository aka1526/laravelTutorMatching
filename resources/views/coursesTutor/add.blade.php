<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TUTORMATCHING') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/courses/addCourses.css') }}">

    <title>Laravel</title>

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        .text-red{
            color: red;
        }
    </style>
</head>

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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/tutor/course') }}">วิชาที่เปิดสอน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">แชท</a>
                    </li>
                    <li class="nav-item">
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

    <div class="container-port ">
        <div class="row text-center py-1">
            <div class="col-12 pb-2">
                <h2 class="text-red"><b>เพิ่มรายวิชา</b></h2>
            </div>
        </div>
        <div class="row row-main">
            <strong>ข้อมูลวิชา</strong>
            <strong>รูปวิชา</strong>

            <form method="POST" action="{{ route('tutor.addCourse') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="tutor_id" value="{{ auth()->guard('tutor')->user()->id }}">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="col-lg-5 col-md-12 col-sm-12 col1">
                    <input type="file" name="course_img" class="form-control" required>
                    @error('course_img')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <div class="form-group my-2">
                        <!-- <strong>ชื่อหลักสูตร</strong> -->
                        <input type="text" name="course_name" class="form-control" placeholder="ชื่อวิชา" required>
                        @error('course_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group my-2">
                        <strong>ข้อมูลวิชา</strong>
                        <textarea type="text" name="course_information" class="form-control" placeholder="ข้อมูลวิชา" required></textarea>
                        @error('course_information')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group my-2">
                        <input type="text" name="course_time" class="form-control" placeholder="ระยะเวลาที่สอน"
                            required>
                        @error('course_time')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group my-2">
                        <input type="text" name="course_level" class="form-control" placeholder="ระดับชั้น"
                            required>
                        @error('news_detail')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

        </div>

        <div class="row row-main">
            <strong>รูปแบบการสอน</strong>

            <div class="form-group">
                <label for="option1" class="form-check-label">
                    <input type="checkbox" id="option1" name="course_type[]" value="การสอนแบบตัวต่อตัว"
                        class="form-check-input"> การสอนแบบตัวต่อตัว
                </label>
            </div>
            <div class="form-group">
                <label for="option2" class="form-check-label">
                    <input type="checkbox" id="option2" name="course_type[]" value="การสอนแบบกลุ่ม (4-6 คน)"
                        class="form-check-input"> การสอนแบบกลุ่ม (4-6 คน)
                </label>
            </div>


            <strong>เป้าหมาย</strong>
            <div class="col-md-6">
                <div class="form-group my-2">
                    <textarea type="text" name="course_target" class="form-control"
                        placeholder="เป้าหมายของวิชา เช่น การสอนเพื่อสอบเข้ามหาวิทบสลัย" required></textarea>
                    @error('course_target')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>

        <div class="text">
            <a href="{{ url('/courses') }}" class="btn btn-warning">ย้อนกลับ</a>
            <button type="submit" class="btn btn-success">เพิ่มรายวิชา</button>
        </div>

        </form>



    </div>
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2023 Tutor Matching. All rights reserved.</p>
    </footer>





    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/courses/addCourses.js') }}" defer></script>

</body>

</html>
