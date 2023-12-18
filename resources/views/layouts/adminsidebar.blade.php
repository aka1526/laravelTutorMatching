<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TUTOR-MATCHING</title>
    <link rel="stylesheet" href="{{ asset('css/admincss/sidebar.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

@php
    $img = Auth::user()->img;
@endphp

<style>
    .navbar {
        background-color: rgb(253, 253, 253);
    }

    body {
        font-family: "Kanit", sans-serif;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/admin') }}">
                <img src="{{ url('storage/img/11.png') }}" height="70" alt="Logo" loading="lazy"
                    id="img" />
                TUTOR MATCHING
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarExample01"
                aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarExample01">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
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
                        <!-- Dropdown Menu for Authenticated User -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ url("storage/{$img}") }}" width="45px" height="45px" alt="Profile Picture"
                                    class="profile-image rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end larger-dropdown" aria-labelledby="navbarDropdown">
                                <div class="container">
                                    <img src="{{ url("storage/{$img}") }}" width="45px" height="45px"
                                        alt="Profile Picture" class="profile-image rounded-circle">
                                    {{ Auth::user()->name }}
                                    {{-- {{ Auth::user()->lastname }} --}}
                                </div>
                                <hr>
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
        <div class="logo_details mt-3">
            <img src="{{ url('storage/img/11.png') }}" height="70" alt="" loading="lazy" />
            <a class="logo_name" href="{{ url('/admin') }}" style="text-decoration: none;">TUTOR MATCHING</a>
        </div>
        <ul class="nav-list">
            <li>
                <a href="{{ url('/admin') }}">
                    <i class="bx bx-grid-alt"></i>
                    <span class="link_name">แดชบอร์ด</span>
                </a>

            </li>

            <li>
                <a href="{{ url('/admin/tutors') }}">
                    <i class="bx bx-user"></i>
                    <span class="link_name">ติวเตอร์</span>
                </a>

            </li>


            <li>
                <a href="{{ url('/admin/courses') }}">
                    <i class="bx bx-volume"></i>
                    <span class="link_name">คอร์สเรียน</span>
                </a>

            </li>

            <li>
                <a href="{{ url('/admin/news') }}">
                    <i class="bx bx-chat"></i>
                    <span class="link_name">ข่าวสาร</span>
                </a>

            </li>
        </ul>
    </div>

    

    <section class="home-section px-md-4 py-4" style="left: 250px; width: calc(100% - 250px);">
        <div>
            <div class="info">
                <div class="main">
                    <main>
                        {{-- @yield('breadcrumb') --}}
                        {{-- others --}}
                        @yield('content')
                        
                        {{-- dashboard --}}
                        @yield('dashboard')
                    </main>
                </div>
            </div>
        </div>
    </section>



    <!-- Scripts -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>
