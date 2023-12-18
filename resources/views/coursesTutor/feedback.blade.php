<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TUTOR-MATCHING</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/mycourses.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/feedback.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        #containerCard {
            background-color: whitesmoke;
        }
    </style>
</head>

@php
    $tutor_img = auth()
        ->guard('tutor')
        ->user()->tutor_img;
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
        <h1>รีวิวผลตอบรับ</h1>
        <div class="row">
            <div class="col-xl-6 col-md-6">
                <div class="card bg-danger text-white mb-4 text-center">
                    <div class="card-body" style="padding: 1rem;">
                        <h3>คะแนนรวม</h3>
                        <h2 style="font-size: 1.5rem;">{{ $RatingResults }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6">
                <div class="card bg-danger text-white mb-4 text-center">
                    <div class="card-body" style="padding: 1rem;">
                        <h3>จำนวนรีวิวทั้งหมด</h3>
                        <h2 style="font-size: 1.5rem;">{{ $commentCount }}</h2>
                    </div>
                </div>
            </div>


        </div>

        <div class="container" id="containerCard" style="max-height: 500px; overflow-y: auto;">
            <div class="row">
                @foreach ($comments as $comment)
                    <div class="col-md-4">
                        <div class="card mt-3 position-relative">
                            <span
                                class="badge bg-warning text-dark position-absolute top-0 end-0 mt-2 me-2">{{ $comment->rating }}
                                Stars</span>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <img src="{{ url("storage/{$comment->user->img}") }}" class="rounded-circle"
                                        style="width: 70px; height: 70px; object-fit: cover;" alt="Profile Image">
                                </div>
                                <div>
                                    <h5 class="card-title">{{ $comment->user->name }}</h5>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-md-10">
                                        <p class="card-text">{{ $comment->comment }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <small class="text-muted">{{ $comment->created_at }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>

</html>
