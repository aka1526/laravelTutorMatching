{{-- @extends('layouts.sidebar') --}}
@extends('layouts.adminsidebar')
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

    <main class="py-4">
        @yield('content')
    </main>

    <div class="container">
        
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="text-danger"><b>เพิ่มข้อมูลข่าวสาร</b></h2>
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <!-- ////////////////////////////// -->

                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <!-- <strong>รายละเอียดของข่าวสาร</strong> -->
                            <input type="file" name="news_img" class="form-control" placeholder="รูปข่าวสาร">
                            @error('news_img')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <!-- <strong>ชื่อหัวข้อข่าวสาร</strong> -->
                            <input type="text" name="news_title" class="form-control" placeholder="ชื่อหัวข้อข่าวสาร">
                            @error('news_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group my-2">
                            <!-- <strong>รายละเอียดของข่าวสาร</strong> -->
                            <textarea type="text" name="news_detail" class="form-control" placeholder="รายละเอียดของข่าวสาร"></textarea>
                            @error('news_detail')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group my-2">
                            <!-- <strong>รายละเอียดของข่าวสาร</strong> -->
                            <input type="tel" name="news_tel" class="form-control" placeholder="เบอร์โทร">
                            @error('news_tel')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <a href="{{ url('/admin/news') }}" class="btn btn-warning">Back</a>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                    <!-- <div class="col-md-12 mt-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>  news_img -->
                </div>
            </form>
        </div>
    @endsection
    <!-- </div>
</body>
</html> -->
