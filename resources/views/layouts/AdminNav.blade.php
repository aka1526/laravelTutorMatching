<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TUTORMATCHING') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/boostrap.js')}}"></script>
    <script src="{{ asset('js/boostrap.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">



    <script src="https://unpkg.com/feather-icons"></script>

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script> --}}

    <link rel="stylesheet" href="{{asset('css/AdminSidebar.css')}}">

</head>

<body>
    {{-- nav ส่วนบน --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
        {{-- <img src="{{ url('storage/img/11.png') }}" height="70" alt="" loading="lazy" /> --}}
        <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
            <a class="navbar-brand mx-5" href="{{ url('/admin') }}"> Admin </a>
            <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-bs-toggle="collapse"
                data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        {{-- Search btn --}}
        <div class="col-12 col-md-4 col-lg-2">
            <input type="text" class="form-control form-control-dark" placeholder="Search" aria-label="Search">
        </div>

        {{-- account --}}
        
        <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
            <div class="mr-3 mt-1">
            </div>
            <div class="dropdown show">
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
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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

            
        </div>
    </nav>

    {{-- sidebar --}}
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block navbar-dark bg-dark bg-light">
                <div class="sidebar">
                    <div class="position-fixed">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ url('/admin') }}" class="nav-link active" aria-current="page">
                                    <i data-feather="home"></i>
                                    <span class="ml-2">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/promotes') }}" class="nav-link" aria-current="page">
                                    <i data-feather="volume-2"></i>
                                    <span class="ml-2">Promotes</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/tutors') }}" class="nav-link" aria-current="page">
                                    <i data-feather="users"></i>
                                    <span class="ml-2">Tutors</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/news') }}" class="nav-link" aria-current="page">
                                    <i data-feather="file-text"></i>
                                    <span class="ml-2">News</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>


            {{-- content --}}
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-3">

                {{-- @yield('breadcrumb') --}}

                {{-- context --}}
                @yield('title')

                <div class="main_content">
                    {{-- <div class="header">Welcome!! Have a nice day.</div> --}}
                    <div class="info">
                        <div class="main">
                            <main class="mt-3">
                                {{-- others --}}
                                @yield('content')

                                {{-- dashboard --}}
                                @yield('dashboard')
                            </main>
                        </div>
                    </div>
                </div>
            </main>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        feather.replace()
    </script>

</body>

</html>


