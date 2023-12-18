<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TUTOR-MATCHING</title>


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <style>
        #Imgprofile {
            border-radius: 10px;
        }

        .ma {
            font-size: 13px;
            color: rgb(127, 127, 127)
        }
    </style>
</head>

@php
    $img = Auth::user()->img;
@endphp


<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
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

                                <img src="{{ url("storage/{$img}") }}" width="45px" height="45px" alt="Profile Picture"
                                    class="profile-image rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end larger-dropdown" aria-labelledby="navbarDropdown">
                                <div class="container">
                                    <img src="{{ url("storage/{$img}") }}" width="45px" height="45px"
                                        alt="Profile Picture" class="profile-image rounded-circle">
                                    {{ Auth::user()->firstname }}
                                    {{ Auth::user()->lastname }}
                                </div>
                                <hr>
                                {{-- <a class="dropdown-item"
                                    href="{{ url('/mycourses',Auth::user()->id) }}">คอร์สของฉัน</a> --}}
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
    </nav>

    <div class="container-port">
        <div class="row" id="profile">
            <h3>ประวัติการลงทะเบียนคอร์สเรียนทั้งหมด</h3>
            <div class="row">
                <table class="table">
                    <thead>
                      <tr class=" bg-danger text-white">
                        <th scope="col" >#</th>
                        <th scope="col">เลขที่สมัคร</th>
                        <th scope="col">วันที่สมัคร</th>
                        <th scope="col">ชื่อผู้สมัคร</th>
                        <th scope="col">ชื่อคอร์ส</th>
                        <th scope="col">ราคา</th>
                        <th scope="col">วันที่ต้องการเรียน</th>

                        <th scope="col">เอกสารการโอน</th>
                        <th scope="col" style="width: 180px;">สถานะอนุมัติ</th>

                      </tr>
                    </thead>
                    <tbody>
                @foreach ($CourseRegister as $key=>$item)

                      <tr>
                        <th scope="row">{{ $CourseRegister->firstItem()+$key }}</th>
                        <td>{{ $item->doc_no   }}</td>
                        <td>{{ $item->register_date  }}</td>
                        <td>{{ $item->user_name  }}</td>
                        <td><a href="/course_Details/{{ $item->course_id  }}" class="">{{ $item->course_name  }}</a></td>
                        <td>{{ number_format($item->course_price ,0) }}</td>
                        <td>{{ $item->date_start  }}</td>
                        <td><img src="{{$item->payment_img  }}" width="80px" data-doc-no="{{ $item->doc_no }}" class="viewing" style="cursor: pointer;" ></td>
                        <td>
                        @if($item->approve_status=="W")
                            <button type="button" class="btn btn-warning " style="width: 100%">รออนุมัติ</button>
                        @elseif($item->approve_status=="Y")
                            <button type="button" class="btn btn-success" style="width: 100%">อนุมัติเรียบร้อย</button>
                        @else
                            <button type="button" class="btn btn-danger" style="width: 100%">คืนเงิน</button>
                        @endif
                        </td>
                      </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="mt-3">
            {{ $CourseRegister->links() }}
        </div>
            </div>

        </div>
    </div>



    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2023 Tutor Matching. All rights reserved.</p>
    </footer>
    <script>
    $(document).on("click", '.viewing', function(e) {
        e.preventDefault();
        var formUrl=this.src;
        openPopup(formUrl);

    });

    function openPopup(formUrl) {
        var screenWidth = window.screen.width;
    var screenHeight = window.screen.height;
    var popupWidth = 600;
    var popupHeight = 400;
    var left = (screenWidth - popupWidth) / 2;
    var top = (screenHeight - popupHeight) / 2;
    var popupWindow = window.open(formUrl, 'Popup', 'width=' + popupWidth + ',height=' + popupHeight + ',left=' + left + ',top=' + top);
    if (popupWindow) {
        popupWindow.focus();
    }
    }
    </script>

    <script src="{{ asset('js/tutors/hometutor.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/profile.js') }}" defer></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>
<script>

</script>
</html>
