<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/review.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/tutorhome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comment.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Rating.css') }}">

    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->

    <link rel="stylesheet" href="{{ asset('css/courses/reviewCourse.css') }}">
    {{-- หน้า css หน้า home แบบ nouser --}}
    <!-- <link rel="stylesheet" href="{{ asset('css/tutors/tutorhome.css') }}"> -->
    {{-- dropdown ตรง profile --}}
    <!-- <link rel="stylesheet" href="{{ asset('css/tutors/account.css') }}"> -->

    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-...." crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">


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
                        <a class="nav-link" href="{{ url('/tutorList ') }}">ติวเตอร์</a>
                    </li>
                    <li class="nav-item" id="navlink1">
                        <a class="nav-link" href="{{ url('#') }}">แชท</a>
                    </li>


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
        </div>
    </nav>

    <!-- ------------------------------------------------------------------------------------- -->


    <div class="container-port">
        <div class="mb-2">
            <a href="#" id="backbtn" class="btn btn-danger text-white" onclick="history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i>  กลับไปหน้าที่แล้ว</a>
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
                {{ __('คะแนน:') }}<i class="fa-solid fa-star fa-lg fa-3x" style="color: #ffeb0a;"></i>
                {{ $RatingResults }}
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
                            {{ __('เวลาในการสอน :') }} {{ $courses->course_time }} {{ __('ชั่วโมง') }}
                        </div>
                        <div id="item-1">
                            <h3 class="text-danger"> {{ __('ค่าลงทะเบียน :') }} {{ number_format($courses->course_price,0) }} {{ __(' บาท') }}</h3>
                         </div>

                         <div class="button-container text-center mt-3" >
                            @if(!$CourseRegister)
                            <a href="{{ route('reg.index',$courses->id)  }}" class="btn btn-danger mt-auto mx-auto"><i class="fa fa-graduation-cap"></i> ลงทะเบียน</a>

                            @endif

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
            @if($CourseRegister)
            <form class="py-4" action="{{ route('userComment', ['id' => $tutors->id]) }}" method="POST"
                id="comment-form">
                @csrf

                <input type="hidden" name="course_id" id="course_id" value="{{ $courses->id }}">
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">

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
                <button type="submit" style="float: right;" class="com">ส่งความคิดเห็น</button>
            </form>
            @endif

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
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'success',
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2023 Tutor Matching. All rights reserved.</p>
    </footer>

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

        $(document).on("click", '.btn-delete', function(e) {

            var frm = $("#frm_delete_comment");
            var url = frm.attr('action');
            var comment_id = $(this).data('id');
            if (comment_id) {

                Swal.fire({
                    title: 'คุณต้องการลบหรือไม่?',
                    // text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'ยกเลิก',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ลบความคิดเห็น'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: "post",
                            url: url,
                            data: {
                                id: comment_id,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(data) {
                                if (data) {
                                    Swal.fire({
                                        icon: data.icon,
                                        title: data.msg,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        location.reload();
                                    })
                                }

                            }
                        });
                    }
                })
            }

        });
    </script>
</body>

</html>
