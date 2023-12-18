<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TUTOR-MATCHING</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/courses.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-...." crossorigin="anonymous" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    <!-- Styles -->
    <style>
        #navlink1 a:hover {
            color: #ff3232;
        }

        .nav-link.btn.btn-danger {
            border-radius: 20px;
            color: whitesmoke;
            font-weight: bold;
            margin-bottom: 9px;
        }

        .button-container {
    display: flex;
    justify-content: space-around; /* Adjust as needed */
    align-items: center;
}

    </style>
</head>


<body>


    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <img src="{{ url('storage/img/11.png') }}" height="70" alt="" loading="lazy" />
            <a class="navbar-brand" href="{{ url('/') }}">TUTOR MATCHING</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarExample01"
                aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarExample01">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <li class="nav-item" id="navlink1">
                        <a class="nav-link" href="{{ url('/tutor') }}">สำหรับติวเตอร์</a>
                    </li>
                    <li class="nav-item" id="navlink1">
                        <a class="nav-link" href="{{ url('/course') }}">คอร์สเรียน</a>
                    </li>
                    <li class="nav-item" id="navlink1">
                        <a class="nav-link" href="{{ url('/tutorsList') }}">ติวเตอร์</a>
                    </li>


                </ul>
                <ul class="navbar-nav mx-2  ">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link btn btn-danger" href="{{ route('login') }}"><i class="fa fa-key"></i> {{ __('เข้าสู่ระบบ') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                <img src="{{ url("storage/{$img}") }}" width="45px" height="45px" alt="Profile Picture"
                                    class="profile-image rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end larger-dropdown" aria-labelledby="navbarDropdown">
                                <div class="container">
                                    <img src="{{ url("storage/{$img}") }}" width="45px" height="45px"
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
    </nav>

    <!-- ------------------------------------------------------------------------------------- -->

    <div class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="container id="fitering">
                        <div class="sidebar mt-4">
                            <h5><strong>ติวเตอร์</strong></h5>
                            <h6><strong>วิชา</strong></h6>
                            <form id="{{ route('nouser.course') }}" action="#" method="GET">
                                <div class="row">
                                    @foreach ($subjects as $subject)
                                        <label>
                                            <input type="checkbox" name="subject[]" value="{{ $subject->id }}">
                                            {{ $subject->subject_name }}
                                        </label>
                                    @endforeach
                                </div>
                                <!-- Add more checkboxes as needed -->
                                <h6 class="mt-2"><strong>ระดับการศึกษา</strong></h6>
                                <div class="row">
                                    <label>
                                        <input type="checkbox" name="course_level[]" value="มัธยมศึกษาตอนต้น">
                                        มัธยมศึกษาตอนต้น
                                    </label>
                                    <label>
                                        <input type="checkbox" name="course_level[]" value="มัธยมศึกษาตอนปลาย">
                                        มัธยมศึกษาตอนปลาย
                                    </label>
                                </div>

                                <div>
                                    <button class="btn btn-danger" type="submit"><i
                                            class='bx bx-filter'></i></button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="container mt-4">
                        <form action="{{ route('nouser.course') }}" method="GET">
                            <div class="row">
                                <div class="col-11">
                                    <input type="text" name="query" class="form-control" placeholder="ค้นหา">
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="btn btn-danger"><i
                                            class="fa fa-search"></i></button>
                                </div>
                        </form>
                    </div>
                    <!-- Main content -->
                    <div class="row" id="courseList">
                        @foreach ($courses as $course)
                            <div class="col-md-4 mt-4">
                                <div class="card">
                                    <img src="{{ url("storage/{$course->course_img}") }}" height="200vh"
                                        class="card-img-top" alt="Course Image">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $course->course_name }} </h5>
                                        <h5 class="card-title">{{ 'สอนโดย '.$tutors[$teaches[$course->id ]]  }}</h5>

                                        <p class="card-text">{{ $course->course_level }}</p>
                                        <div class="button-container">

                                            <a href="{{ route('reg.index', $course->id )}}" class="btn btn-danger mt-auto mx-auto"><i class="fa fa-graduation-cap"></i> ลงทะเบียน</a>
                                            <a href="{{ route('nouserCourseDetails', $course->id) }}" class="btn btn-danger mt-auto mx-auto"><i class="fa fa-eye"></i> ดูรายละเอียด</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2023 Tutor Matching. All rights reserved.</p>
    </footer>
    <script>
        AOS.init();
      </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/tutors/hometutor.js') }}" defer></script>
</body>

</html>
