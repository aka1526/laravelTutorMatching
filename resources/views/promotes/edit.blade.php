@extends('layouts.adminsidebar')

<link rel="stylesheet" href="{{ asset('css/admincss/tutoredit.css') }}">

@section('content')
    <div class="collapse navbar-collapse position-absolute top-50 start-50 translate-middle" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ url('/') }}">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ url('/promotes') }}">PROMOTE</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ url('/tutors') }}">TUTOR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ url('/news') }}">NEWS</a>
            </li>
        </ul>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
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
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>

@section('title')
    <div class="col-lg-12">
        <h1 class="h2">แก้ไขโปรโมต</h1>
    </div>
@endsection

<div class="container mt-2">
    <div class="row">
        <div class='container py-4'>
            <h1 class="h2">อนุมัติคอร์สเรียน</h1>
            <div class='row'>
                @if ($message = Session::get('success'))
                    <div class="alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
            </div>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="container" id="container">
            <div class="tutor-info">
                <div class="info-group">
                    <div class="info-field">
                        <img class="tutor-image" width="150px" height="100px"
                            src="{{ url("storage/{$courses->course_img}") }}" />
                        <form action="{{ route('admin.courses.update', $courses->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            {{-- @method('PUT') --}}
                            <div class="row">
                                <!-- <div class="col-md-12">
                                    <div class="form-group my-2">
                                        <strong>ชื่อหัวข้อข่าวสาร</strong>
                                        <input type="text" name="course_id" value="{{ $courses->id }}"
                                            class="form-control" placeholder="รหัส" required readonly>
                                        @error('course_id')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                                    </div>
                                </div> -->


                                <div class="col-md-12">
                                    <div class="form-group my-2">
                                        <strong>ชื่อติวเตอร์</strong>
                                        @foreach ($courses->tutors as $tutor)
                                            <input type="text" name="tutor_fullname"
                                                value="{{ $tutor->tutor_firstname }} {{ $tutor->tutor_lastname }}"
                                                class="form-control" placeholder="รหัส" readonly>
                                        @endforeach
                                        @error('tutor_fullname')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group my-2">
                                        <strong>ชื่อคอร์สเรียน</strong>
                                        <input type="text" name="course_name" value="{{ $courses->course_name }}"
                                            class="form-control" placeholder="หัวข้อ" readonly>
                                        @error('course_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">

                                    <div class="form-group my-2">
                                        <strong>รายละเอียดคอร์สเรียน</strong>
                                        <textarea type="text" name="course_information" class="form-control"
                                            placeholder="{{ $courses->course_information }}" readonly></textarea>
                                        @error('course_information')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="form-group my-2">
                                        <strong>ระดับในการสอน</strong>
                                        <input type="text" name="course_level"
                                            value="{{ $courses->course_level }}" class="form-control"
                                            placeholder="ระดับในการสอน" readonly>
                                        @error('course_level')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group my-2">
                                        <strong>รูปแบบการสอน</strong>
                                        <input type="text" name="course_type" value="{{ $courses->course_type }}"
                                            class="form-control" placeholder="รูปแบบการสอน" readonly>
                                        @error('course_type')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group my-2">
                                        <strong>เป้าหมายการสอน</strong>
                                        <input type="text" name="course_target"
                                            value="{{ $courses->course_target }}" class="form-control"
                                            placeholder="เป้าหมายการสอน" readonly>
                                        @error('course_target')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group my-2">
                                        <strong>เวลาในการร้องขอ</strong>
                                        <input type="text" name="course_created_at"
                                            value="{{ $courses->created_at }}" class="form-control"
                                            placeholder="วันเดือนปี" readonly>
                                        @error('course_created_at')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                    <a href="{{ route('courses.index') }}" class="btn btn-warning">ย้อนกลับ</a>
                                    <button type="submit" class="btn btn-success">อนุมัติคอร์สเรียน</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
@endsection
