a
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TUTORMATCHING') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/review.css') }}">
    {{-- หน้า css หน้า home แบบ nouser --}}
    <link rel="stylesheet" href="{{ asset('css/tutors/tutorhome.css') }}">
    {{-- dropdown ตรง profile --}}
    <link rel="stylesheet" href="{{ asset('css/tutors/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comment.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Rating.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet'>
    <title>Laravel</title>
    <style>
        .nav-link.btn.btn-danger {
            border-radius: 20px;
            color: whitesmoke;
            font-weight: bold;
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
                                    href="{{ route('login') }}">{{ __('เข้าสู่ระบบ') }}</a>
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

        {{-- <div class="mb-4">
            <a href="#" id="backbtn" class="btn btn-danger" onclick="history.go(-1); return false;">
                < ไปหน้าที่แล้ว</a>
        </div> --}}


        <div class="row row-main">
            <div class="col-lg-5 col-md-12 col-sm-12 col1">
                <img width="100%" height="80%" src="{{ url("storage/{$tutors->tutor_img}") }}" />
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <h2><strong>ประวัติ</strong></h2>
                <hr>
                <h3>ชื่อ {{ $tutors->tutor_firstname }} {{ $tutors->tutor_lastname }}</h3>
                <i class="fa-solid fa-star fa-lg fa-3x" style="color: #ffeb0a;"></i>
                {{ $RatingResults }}

                <div class="subj">
                    <h4>วิชาที่สอน</h4>
                    @foreach ($courses as $course)
                        @if ($course->tutor_id == $tutors->id)
                            {{ $course->course_name }},
                        @else
                            ไม่มีคอร์สที่ลงทะเบียน
                        @endif
                    @endforeach
                    <br> <br>
                    <h6>ระดับที่สอน</h6>
                    @php
                        $uniqueLevels = array_unique($courses->pluck('course_level')->toArray());
                    @endphp

                    @foreach ($uniqueLevels as $level)
                        <button class="btn btn-danger">{{ $level }}</button>
                    @endforeach
                </div>
                <div class="portfolio">
                    <ul>
                        <li>ระดับการศึกษา : {{ $tutors->infotutor->info_tutor_education }}</li>
                        <li>จบศึกษา : {{ $tutors->infotutor->info_tutor_univercity }}</li>
                        <li>คณะ : {{ $tutors->infotutor->info_tutor_faculty }} </li>
                        <li>สาขา : {{ $tutors->infotutor->info_tutor_major }}</li>
                        <li>ประสบการ์ณสอน : {{ $tutors->infotutor->info_tutor_exp }} ปี</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container mt-5" id="comment">
            <h4>ความคิดเห็น</h4>
            <form class="py-4" action="{{ route('userComment', ['id' => $tutors->id]) }}" method="POST"
                id="comment-form">
                @csrf

                {{-- <input type="text" value="{{ Auth::user()->id }}" name="user_id" hidden> --}}
                <label for="comment">ความคิดเห็น:</label>
                <textarea id="comment" name="comment" rows="2" placeholder="แสดงความคิดคิด" required></textarea>
                <div class="rate">
                    <input type="radio" id="star5" name="rating" value="5" />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="rating" value="4" />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="rating" value="3" />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="rating" value="2" />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="rating" value="1" />
                    <label for="star1" title="text">1 star</label>
                </div>
                <button class="com" type="submit" style="float: right;">ส่งความคิดเห็น</button>
            </form>


            <ul id="comment-list" class="mt-5">
                ความคิดเห็น {{ $comments->count() }} รายการ
                @foreach ($comments as $comment)
                    <div>
                        <li>
                            <div class="comment-info">
                                <span class="comment-author">{{ $comment->user->firstname }} </span>
                                <span class="comment-date">{{ $comment->created_at }}</span>
                            </div>
                            <p class="comment-text">{{ $comment->comment }}</p>
                        </li>
                    </div>
                @endforeach
            </ul>
        </div>
    </div>

    <section>
        <div class="container">
            <h3>คอร์สที่สอน</h3>
            <section class="container my-5">
                <div class="row">
                    @foreach ($courses as $course)
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="{{ url("storage/{$course->course_img}") }}" height="200vh"
                                    class="card-img-top" alt="Course Image">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $course->course_name }}</h5>
                                    <p class="card-text">{{ $course->course_level }}</p>
                                    <a href="{{ route('nouserCourseDetails', $course->id) }}"
                                        class="btn btn-danger mt-auto mx-auto">ดูรายละเอียด</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>



    </section>


    <script>
        document.getElementById('comment-form').addEventListener('submit', function(event) {
            // Check if the user is authenticated
            @guest
            // Prevent the form submission
            event.preventDefault();
            // Redirect to the login page
            window.location.href = "{{ route('login') }}";
        @endguest
        });
    </script>
    <script src="https://kit.fontawesome.com/34ec02d614.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>
