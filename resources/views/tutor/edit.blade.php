@extends('layouts.adminsidebar')

<link rel="stylesheet" href="{{ asset('css/admincss/tutoredit.css') }}">

@section('content')

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
        <h1 class="h2">Tutor Detail</h1>
    </div>
@endsection

<div class="container mt-2">
    <div class="row">
        <div class="container py-4">
            <h1 class="h2"><b>อนุมัติติวเตอร์</b></h1>
            <div class="row">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
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
                            src="{{ url("storage/{$tutors->tutor_img}") }}" />

                        <div class="form-group my-2">
                            <strong>การศึกษา</strong>
                            <input type="text" name="info_tutor_education"
                                value="{{ $tutors->infotutor->info_tutor_education }}" class="form-control"
                                placeholder="การศึกษา" readonly>
                            @error('info_tutor_education')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group my-2">
                            <strong>คณะ</strong>
                            <input type="text" name="info_tutor_faculty"
                                value="{{ $tutors->infotutor->info_tutor_faculty }}" class="form-control"
                                placeholder="คณะ" readonly>
                            @error('info_tutor_faculty')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group my-2">

                            <strong>สาขา</strong>
                            <input type="text" name="info_tutor_major"
                                value="{{ $tutors->infotutor->info_tutor_major }}" class="form-control"
                                placeholder="สาขา" readonly>
                            @error('info_tutor_major')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group my-2">

                            <strong>เกรด</strong>
                            <input type="text" name="info_tutor_grade"
                                value="{{ $tutors->infotutor->info_tutor_grade }}" class="form-control"
                                placeholder="เกรด" readonly>
                            @error('info_tutor_grade')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group my-2">
                            <strong>มหาวิทยาลัย</strong>

                            <input type="text" name="info_tutor_univercity"
                                value="{{ $tutors->infotutor->info_tutor_univercity }}" class="form-control"
                                placeholder="มหวิทยาลัย" readonly>
                            @error('info_tutor_univercity')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group my-2">

                            <strong>สถานที่</strong>
                            <input type="text" name="info_tutor_location"
                                value="{{ $tutors->infotutor->info_tutor_location }}" class="form-control"
                                placeholder="สถานที่" readonly>
                            @error('info_tutor_location')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group my-2">
                            <strong>ประสบการณ์</strong>
                            <input type="text" name="info_tutor_exp"
                                value="{{ $tutors->infotutor->info_tutor_exp }}" class="form-control"
                                placeholder="ประสบการณ์" readonly>
                            @error('info_tutor_exp')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>




            </div>
            <form action="{{ route('tutors.update', $tutors->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="buttons">
                    <a href="{{ route('tutors.index') }}" class="btn btn-warning">ย้อนกลับ</a>
                    <button type="submit" class="btn btn-success">อนุมัติติวเตอร์</button>
                </div>
            </form>
        </div>


    </div>
</div>

@endsection
