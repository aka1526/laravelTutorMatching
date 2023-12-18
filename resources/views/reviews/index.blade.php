<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TUTOR-MATCHING</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/review.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/tutorhome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comment.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Rating.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->

    <!-- <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>


    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet'>
    <title>Laravel</title>
    <style>
        /* .btn-edit {
            justify-content: right;
            background-color: #ffeb0a;
            color: #ffffff;
            height: 30%;
            width: 20%;
        } */
    </style>
</head>

@php
    $user_img = Auth::user()->img;
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
                        <a class="nav-link" href="#">แชท</a>
                    </li>
                </ul>
                <ul class="navbar-nav mx-2  ">
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
                    <h4>คอร์สที่สอน</h4>

                    @if ($courses->isEmpty())
                        ไม่มีคอร์สที่ลงทะเบียน
                    @else
                        @foreach ($courses as $course)
                            {{ $course->course_name }}
                        @endforeach
                    @endif

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
                        <li>ประสบการณ์สอน : {{ $tutors->infotutor->info_tutor_exp }} ปี</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- <div class="container mt-5" id="comment">
            <h4>ความคิดเห็น</h4>
            <form class="py-4" action="{{ route('userComment', ['id' => $tutors->id]) }}" method="POST"
                id="comment-form">
                @csrf
                <input type="text" value="{{ Auth::user()->id }}" name="user_id" hidden>
                <label for="comment">ความคิดเห็น:</label>
                <textarea id="comment" name="comment" rows="2" placeholder="แสดงความคิดเห็น" required></textarea>
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
                <button  type="submit" style="float: right;" class="com">ส่งความคิดเห็น</button>
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
                            
                            <form method="POST" action="{{ route('comments.destroy', $comment) }}">

                                {{-- ----------------------------------------------------- --}}
                                
                                @if ($comment->user_id == auth()->user()->id)
<a href="#" data-id="{{ $comment->id }}"
                                        class="btn btn-outline-warning edit-comment" id="myCollapse"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <button type="submit" class=" btn btn-outline-danger"><i
                                            class="fa-solid fa-trash"></i></button>
@else
@endif

                                @csrf
                                @method('DELETE')

                            </form>

                        </li>


                    </div>
@endforeach
            </ul>
        </div> -->


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
                                    <a href="{{ route('userCourseDetails', $course->id) }}"
                                        class="btn btn-danger mt-auto mx-auto">ดูรายละเอียด</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="py-4" action="{{ route('comments.update') }}" method="POST" id="comment-form">
                    @csrf
                    <input type="hidden" id="comment_id" name="comment_id" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขความคิดเห็น</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">แสดงความคิดเห็น</label>
                                <textarea id="edit_comment" name="edit_comment" rows="2" placeholder="แสดงความคิดเห็น" required=""></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-outline-success ">บันทึกการแก้ไข</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- btn-primary
btn-secondary -->

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-success">
            {{ session('error') }}
        </div>
    @endif

    <script src="https://kit.fontawesome.com/34ec02d614.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script>
        $(document).on("click", '#myCollapse', function(e) {
            var id = $(this).data('id');
            var url = "/comments/" + id + "/data"; // 'ctl/save'
            // alert(url);
            $.ajax({
                type: "get",
                url: url,
                data: {
                    id: id,

                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    // console.log(data);
                    var data = data.result;
                    $("#comment_id").val(data.id);
                    $("#edit_comment").val(data.comment);
                    $('#exampleModal').modal('show');

                }
            });

        });

        $(document).on("click", '#myCollapse', function(e) {
            var id = $(this).data('id');
            var url = "/comments/" + id + "/data"; // 'ctl/save'
            // alert(url);
            $.ajax({
                type: "get",
                url: url,
                data: {
                    id: id,

                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    // console.log(data);
                    var data = data.result;
                    $("#comment_id").val(data.id);
                    $("#edit_comment").val(data.comment);
                    $('#exampleModal').modal('show');

                }
            });

        });
    </script>

</body>

</html>
