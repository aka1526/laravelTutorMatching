<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TUTORMATCHING') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/review.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/tutorhome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comment.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Rating.css') }}">

    <link rel="stylesheet" href="{{ asset('css/courses/reviewCourse.css') }}">


    {{-- หน้า css หน้า home แบบ nouser --}}
    <!-- <link rel="stylesheet" href="{{ asset('css/tutors/tutorhome.css') }}"> -->

    {{-- dropdown ตรง profile --}}
    <!-- <link rel="stylesheet" href="{{ asset('css/tutors/account.css') }}"> -->

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

@php
    $tutor_img = auth()
        ->guard('tutor')
        ->user()->tutor_img;
    // dd(auth()->guard('tutor')->user());
@endphp

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <img src="{{ url('storage/img/11.png') }}" height="70" alt="Logo" loading="lazy" />
            <a class="navbar-brand" href="{{ url('/tutor/home') }}">TUTOR MATCHING</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarExample01"
                aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarExample01">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <li class="nav-item mt-2">
                        <a class="nav-link" href="{{ url('/tutor/course') }}">คอร์สเรียน</a>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="nav-link" href="{{ url('/tutor/tutorLists') }}">ติวเตอร์</a>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="nav-link" href="#">แชท</a>
                    </li>

                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link btn btn-danger" href="{{ route('login') }}">{{ __('เข้าสู่ระบบ') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ url("storage/{$tutor_img}") }}" width="45" height="45"
                                    alt="Profile Picture" class="profile-image rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end larger-dropdown" aria-labelledby="navbarDropdown">
                                <div class="container">
                                    <img src="{{ url("storage/{$tutor_img}") }}" width="45" height="45"
                                        alt="Profile Picture" class="profile-image rounded-circle">
                                    {{ auth()->guard('tutor')->user()->tutor_firstname }}
                                    {{ auth()->guard('tutor')->user()->tutor_lastname }}
                                </div>
                                <hr>
                                <a class="dropdown-item"
                                    href="{{ route('tutor.mycourse', Auth::user()->id) }}">คอร์สของฉัน</a>
                                <a class="dropdown-item"
                                    href="{{ url('/tutor/profile', Auth::user()->id) }}">ตั้งค่าบัญชี</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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



    <div class="container-port">
        <div class="mb-2">
            <a href="#" id="backbtn" class="" onclick="history.go(-1); return false;">
                กลับไปหน้าที่แล้ว</a>
        </div>
        <h3 class="mb-4">รายละเอียดคอร์สเรียน</h3>
        <div class="row row-main">
            <div class="col-lg-5 col-md-12 col-sm-12 col1">
                <img src="{{ url("storage/{$courses->course_img}") }}" style="max-width: 95%;" height="250vh"
                    class="card-img-top" alt="Course Image">
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
                            {{ __('ระดับการสอน : :') }} {{ $courses->course_level }}
                        </div>
                        <div id="item-1">
                            {{ __('เวลาในการสอน :') }} {{ $courses->course_time }} {{ __('ชั่วโมง') }}
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


        <div class="container mt-5" id="comment">
            <h4>ความคิดเห็น</h4>
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
                            <!-- <p>{{ $comment->comment }}</p> -->
                            <form id="frm_delete_comment" name="frm_delete_comment" method="POST"
                                action="{{ route('comments.destroy', $comment) }}">
                                @csrf

                                {{-- ----------------------------------------------------- --}}
                                <!-- {{ route('comments.edit', $comment) }} -->
                                @if ($comment->user_id == auth()->user()->id)
                                    <a href="#" data-id="{{ $comment->id }}"
                                        class="btn btn-outline-warning edit-comment" id="myCollapse"><i
                                            class="fa-solid fa-pen-to-square"></i>แก้ไข</a>
                                    <button type="button" data-id="{{ $comment->id }}"
                                        class=" btn btn-outline-danger btn-delete"><i
                                            class="fa-solid fa-trash"></i>ลบ</button>
                                @endif




                            </form>

                        </li>


                    </div>
                @endforeach
            </ul>
        </div>



    </div>

    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2023 Tutor Matching. All rights reserved.</p>
    </footer>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>
