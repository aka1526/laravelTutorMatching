<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TUTOR-MATCHING</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/mycourses.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

    <div class="sidebar">
        <ul class="sidebar-nav">
            <li><a href="{{ route('tutor.mycourse',auth()->guard('tutor')->user()->id) }}">คอร์สของฉัน</a></li>
            <li><a href="{{ route('tutor.mycourse.register',auth()->guard('tutor')->user()->id) }}">รายชื่อผู้ซื้อคอร์ส</a></li>
            <li><a href="{{ route('feedback', ['id' => auth()->guard('tutor')->user()->id]) }}">รีวิวผลตอบรับ</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>คอร์สของฉัน</h1>
        <div class="container">
            <ul class="nav nav-tabs" id="tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="courses-tab" data-toggle="tab" href="#courses">คอร์สทั้งหมด</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="addCourses-tab" data-toggle="tab" href="#addCourses">เพิ่มคอร์ส</a>
                </li>
            </ul>


            <div class="tab-content" id="tabContent">

                {{-- ---------------------- courses ทั้งหมด---------------- --}}
                <div class="tab-pane fade show active" id="courses">
                    <div class="row text-center">
                        <div class="col-12 pb-2">
                            <h2 class="text-red mt-2"><b>คอร์สทั้งหมด</b></h2>
                        </div>
                    </div>
                    <div class="col-md-9 ">
                        <div class="row" id="courseList">
                            @foreach ($courses as $course)
                                <div class="col-md-4 mt-4">
                                    <div class="card">
                                        <img src="{{ url("storage/{$course->course_img}") }}" height="200vh"
                                            class="card-img-top" alt="Course Image">
                                        <div class="card-body d-flex flex-column">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h5 class="card-title">{{ $course->course_name }}</h5>
                                                </div>
                                                <div class="col-md-2">
                                                    @if ($course->course_status == 1)
                                                        <span class="dot dot-green"></span>
                                                    @else
                                                        <span class="dot dot-red"></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="card-text">{{ $course->course_level }}</p>
                                            <a href="{{ route('tutor.mycourse.detail', $course->id) }}"
                                                class="btn btn-danger mt-auto mx-auto">ดูรายละเอียด</a>
                                            <!-- <form method="POST" action="{{ route('courses.destroy', $courses) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class=" btn btn-outline-danger">ลบ</button>

                                            </form> -->

                                            <!-- <form method="POST" action="{{ route('courses.destroy', $course->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class=" btn btn-outline-danger"></button>Delete</button>
                                            </form> -->
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <!-- Pagination -->
                        {{ $courses->links() }}

                    </div>
                </div>




                {{-- ---------------------- เพิ่ม courses ------------------ --}}
                <div class="tab-pane fade" id="addCourses">

                    <div class="container">
                        <div class="row text-center">
                            <div class="col-12 pb-2">
                                <h2 class="text-red mt-2"><b>เพิ่มรายวิชา</b></h2>
                            </div>
                        </div>


                        <div class="container" id="containerAddcourse">
                            <div class="row row-main d-flex justify-content-center">
                                <strong>ข้อมูลวิชา</strong>
                                <strong>รูปวิชา</strong>
                                {{-- ------------------------------------------------------- --}}
                                <form method="POST" action="{{ route('tutor.addCourse') }}"
                                    enctype="multipart/form-data">
                                    @csrf


                                    <input type="hidden" name="tutor_id"
                                        value="{{ auth()->guard('tutor')->user()->id }}">

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="">
                                        <input type="file" name="course_img" class="form-control" required>
                                        @error('course_img')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="">
                                        <div class="form-group my-2">
                                            <!-- <strong>ชื่อหลักสูตร</strong> -->
                                            <input type="text" name="course_name" class="form-control"
                                                placeholder="ชื่อวิชา" required>
                                            @error('course_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <strong>ข้อมูลวิชา</strong>

                                    <div class="">
                                        <div class="form-group my-2"></div>
                                            <!-- <label for="option">วิชา:</label> -->
                                            <!-- <strong>วิชา:</strong> -->
                                            <select name="subject_id" id="option" class="form-control">
                                                <option>เลือกวิชา</option>
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->id }}" required>
                                                        {{ $subject->subject_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('subject_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="">
                                        <div class="form-group my-2">
                                            <textarea rows="4" cols="50" type="text" name="course_information" class="form-control"
                                                placeholder="ข้อมูลวิชา" required></textarea>
                                            @error('course_information')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="">
                                        <div class="form-group my-2">
                                            <textarea rows="4" cols="50" type="text" name="course_content" class="form-control"
                                                placeholder="เนื้อหาที่สอน" required></textarea>
                                            @error('course_content')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-4">
                                        <div class="form-control ">
                                            <label for="course_time">จำนวนชั่วโมงที่สอน </label>
                                            <input type="number" name="course_time" class="form-control" placeholder="จำนวนชั่วโมงที่สอน" required>
                                            @error('course_time')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-control ">
                                            <label for="course_total_day">จำนวนวันหมดอายุ(วัน) เมื่อลงทะเบียนแล้ว</label>
                                            <input type="number" name="course_total_day" class="form-control" min="0" step="1" placeholder="จำนวนวันหมดอายุ"  >
                                            @error('course_total_day')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-control ">
                                            <label for="course_price">ค่าลงทะเบียน</label>
                                            <input type="number" name="course_price" class="form-control" min="0" step="1" placeholder="ค่าลงทะเบียน"  >
                                            @error('course_price')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                    <div class="">
                                        <select name="course_level" class="form-control" required>
                                            <option value="">ระดับชั้น</option>
                                            <option value="มัธยมศึกษาตอนต้น">มัธยมศึกษาตอนต้น</option>
                                            <option value="มัธยมศึกษาตอนปลาย">มัธยมศึกษาตอนปลาย</option>
                                        </select>
                                        @error('course_level')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- </div> --}}
                                    <div class="row row-main">
                                        <strong>รูปแบบการสอน</strong>
                                        <div class="form-group">
                                            <label for="option1" class="form-check-label">
                                                <input type="checkbox" id="option1" name="course_type[]"
                                                    value="การสอนแบบตัวต่อตัว" class="form-check-input">
                                                การสอนแบบตัวต่อตัว
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="option2" class="form-check-label">
                                                <input type="checkbox" id="option2" name="course_type[]"
                                                    value="การสอนแบบกลุ่ม" class="form-check-input"> การสอนแบบกลุ่ม
                                            </label>
                                        </div>
                                        <strong>เป้าหมาย</strong>
                                        <div class="">
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
                                        <a href="#" class="btn btn-warning">ย้อนกลับ</a>
                                        <button type="submit" class="btn btn-success">เพิ่มรายวิชา</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>



    </div>
</body>

</html>
