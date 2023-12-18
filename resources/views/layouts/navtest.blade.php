<!DOCTYPE html>
<html>

<head>
    <title>TUTOR-MATCHING</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/tutorhome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/account.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Chewy' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/tutors/hometutor.js') }}" defer></script>
</head>

<style>
    .hidden {
        display: none;
    }

    .ctn {
        text-decoration: none;
    }
</style>
@php

    $img = Auth::user()->img;
@endphp

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <img src="{{ url('storage/img/11.png') }}" height="70" alt="" loading="lazy" />
            <a class="navbar-brand" href="{{ route('home', ['userId' => Auth::user()->id]) }}">TUTOR MATCHING</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarExample01"
                aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarExample01">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item" id="navlink1">
                        <a class="nav-link" href="{{ url('/courses') }}">คอร์สเรียน</a>
                    </li>
                    <li class="nav-item" id="navlink1">
                        <a class="nav-link" href="{{ url('/tutorList') }}">ติวเตอร์</a>
                    </li>
                    <li class="nav-item" id="navlink1">
                        <a class="nav-link" href="/chatify">แชท</a>
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
                                {{-- <a class="dropdown-item"
                                    href="{{ url('tutor/mycourses', Auth::user()->id) }}">คอร์สของฉัน</a> --}}
                                <a class="dropdown-item" href="{{ url('/profile', Auth::user()->id) }}">ตั้งค่าบัญชี</a>
                                <a class="dropdown-item" href="{{ url('/history', Auth::user()->id) }}">ประวัติลงคอร์สเรียน</a>
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

    <header>
        <div class="header-content">
            <h2>Welcome to Tutor Matching</h2>
            <div class="line"></div>
            <h1>หาคอร์สที่คุณสนใจ</h1>
            <a href="{{ route('CoursesList') }}" class="ctn">คลิกที่นี้</a>
        </div>
    </header>


    {{-- newss --}}
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach ($news as $index => $new)
                <button type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide-to="{{ $index }}"
                    @if ($index === 0) class="active" aria-current="true" @endif
                    aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($news as $index => $new)
                <div class="carousel-item @if ($index === 0) active @endif">
                    <img src="{{ url("storage/{$new->news_img}") }}" class="d-block w-100"
                        alt="Slide {{ $index + 1 }}">
                    <div class="carousel-caption">
                        <h3>{{ $new->news_title }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



    <section class="courses text-center py-4">
        <div class="container">
            <h1 class="display-3">TUTOR MATCHING</h1>
            <h2 class="text-center mb-3">แนะนำคอร์สที่คุณสนใจ</h2>
            <hr>
            {{-- <a href='{{ route('tutor.course') }}' class="btn" id="btncourse">ดูคอร์สเรียน</a> --}}
        </div>
    </section>

    <!-- แนะนำ Courses -->
    <section class="container my-5">
        <div class="row">
            @foreach ($courses as $course)
                <div class="col-md-3 mb-4 " data-aos="fade-down" >
                    <div class="card">
                        <img src="{{ url("storage/{$course->course_img}") }}" height="200vh" class="card-img-top"
                            alt="Course Image">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $course->course_name }}  </h5>
                            <h5 class="card-title text-danger">สอนโดย อ.  {{ isset($teachex[$course->id]) && isset($tutorx[$teachex[$course->id]]) ? $tutorx[$teachex[$course->id]] : '-' }}</h5>
                            <p class="card-text">{{ $course->course_level }}</p>

                            <div class="button-container">

                                <a href="{{ route('reg.index',$course->id) }}" class="btn btn-danger mt-auto mx-auto"><i class="fa fa-graduation-cap"></i> ลงทะเบียน</a>
                                <a href="{{ route('userCourseDetails', $course->id) }}" class="btn btn-danger mt-auto mx-auto"><i class="fa fa-eye"></i> ดูรายละเอียด</a>
                            </div>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>




    <section>
        <div class="container">
            <hr>
        </div>
    </section>




    <section class="container mt-2 text-center">
        <h2>แนะนำติวเตอร์</h2>
        <div class="row justify-content-center">
            @foreach ($similarTutors as $tutor)
                @php
                    $tutorData = $tutors->where('id', $tutor['tutor_id'])->first();
                @endphp
                <div class="col-md-3 mb-4 "  data-aos="fade-up">
                    <a href="{{ route('userTutorDetails', $tutor['tutor_id']) }}" class="tutor-link">
                        <div class="card tutor-card mx-auto text-center">
                            <div class="tutor-img mt-3">
                                <img src="{{ url("storage/{$tutorData->tutor_img}") }}" class="card-img-top rounded-circle" alt="CourseImage">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $tutorData->tutor_firstname }} {{ $tutorData->tutor_lastname }}</h5>
                                <p class="card-text">มหาวิทยาลัย{{ $tutorData->infotutor->info_tutor_univercity }}</p>
                                {{-- <p class="card-text">Cosine Similarity: {{ $tutor['cosine_similarity'] }}</p> --}}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>



    {{-- testttttttttttt matching --}}










    {{-- ----------------------------- footer----------------------- --}}
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2023 Tutor Matching. All rights reserved.</p>
    </footer>

    {{-- <script>
        $('#newsCarousel').carousel();
    </script> --}}
    <script>
        AOS.init();
      </script>

</body>

</html>
