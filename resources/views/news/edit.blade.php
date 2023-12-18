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
        <h1 class="h2">แก้ไขข่าวสาร</h1>
    </div>
@endsection


<div class='container py-4'>
            <h1 class="h2">แก้ไขข่าวสาร</h1>
            <div class='row'>
                @if ($message = Session::get('success'))
                    <div class="alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
            </div>
        </div>

<div class="container mt-2">
    <div class="row">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        {{-- @foreach ($news as $new)
            <td><img width="125px" height="100px" src="{{ url("storage/news/{$new->news_img}") }}" /></td>
        @endforeach --}}

        <div class="container" id="container">
            <div class="tutor-info">
                <div class="info-group">
                    <div class="info-field"></div>
                    <img class="tutor-image" width="150px" height="100px"
                            src="{{ url("storage/{$news->news_img}") }}" />
                        <form action="{{ route('news.update', $news->news_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div>
                                <div class="col-md-12">
                                    <div class="form-group my-2">
                                        <strong>รูปข่าวสาร</strong>
                                        <input type="file" name="news_img" class="form-control" placeholder="รูป"
                                            required>
                                        @error('news_img')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group my-2">
                                        <strong>ชื่อข่าวสาร</strong>
                                        <input type="text" name="news_title" value="{{ $news->news_title }}"
                                            class="form-control" placeholder="ชื่อหัวข้อข่าวสาร" required>
                                        @error('news_title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group my-2">
                                        <strong>รายละเอียดข่าวสาร</strong>
                                        <textarea type="text" name="news_detail" class="form-control" placeholder="{{ $news->news_detail }}" required></textarea>
                                        @error('news_detail')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group my-2">
                                        <strong>เบอร์โทรติดต่อ</strong>
                                        <input type="text" name="news_tel" value="{{ $news->news_tel }}"
                                            class="form-control" placeholder="เบอร์โทร" required>
                                        @error('news_tel')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>




                                <div class="col-12">
                                    <a href="{{ route('news.index') }}" class="btn btn-warning">ย้อนกลับ</a>
                                    <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                                </div>

                            </div>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>
</div>
@endsection
