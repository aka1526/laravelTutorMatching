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
            <div class="col-md-3 col-sm-12 mb-4" id="container_profile_1">
                <form action="{{ route('Profile.uploadProfile', auth()->user()->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="fileInput" id="imgLabel">
                            <h3>รูปโปรไฟล์</h3>
                            <img src="{{ url("storage/{$img}") }}" class="mt-3" id="Imgprofile"
                                style="cursor: pointer; width: 250px; height: 250px;" alt="Profile Image">
                        </label>
                        <input type="file" class="form-control" name="img" id="fileInput"
                            style="display: none;">
                        <div class="button-container mt-2 d-flex justify-content-center">
                            <button type="button" class="btn btn-primary"
                                onclick="document.getElementById('fileInput').click();">เปลี่ยนรูปภาพ</button>
                            @error('img')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="button-container mt-1 d-flex justify-content-center">
                        <button type="submit" class="btn btn-danger">อัพโหลด</button>
                    </div>

                </form>
            </div>


            <div class="col-md-9 col-sm-12">
                <div class="row">
                    <div class="col-md-4">
                        <h3>ข้อมูลบัญชีของคุณ</h3>
                    </div>
                    <div class="col-md-8 d-flex justify-content-end">
                        <div>
                            <box-icon type='solid' name='edit' onclick="togglePages()"></box-icon>
                        </div>
                    </div>
                </div>
                <div class="container mt-4" id="container_profile_2">
                    <div id="main-page">
                        <div class="name">
                            <b>ชื่อผู้ใช้</b> <b class="form-control">{{ $users->name }}</b>
                        </div>
                        <hr>
                        <div class="row" id="info">
                            <div class="col-6">
                                <h5><b>ข้อมูลส่วนตัว</b></h5>
                                <div class="form-control">ชื่อ {{ $users->firstname }} {{ $users->lastname }}</div>
                                <div class="form-control">วันเดือนปีเกิด {{ $users->birthdate }}</div>

                            </div>

                            <div class="col-6" id="contact">
                                <h5><b>การติดต่อ</b></h5>
                                <div class="form-control">เบอร์โทร {{ $users->tel }}</div>
                                <div class="form-control">อีเมลล์ {{ $users->email }}</div>
                                <div class="form-control">ที่อยู่ {{ $users->address }}</div>
                            </div>
                        </div>
                    </div>
                    <div id="sub-page" style="display:none;">
                        <h6><b>แก้ไขโปรไฟล์</b></h6>
                        <form action="{{ route('Profile.editProfile', ['id' => $users->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div>
                                            <label class="ma" for="tutor_birthdate">อีเมล :</label>
                                            <input type="email" name="user_email" class="form-control"
                                                placeholder="อีเมล" value="{{ $users->email }}" disabled>
                                        </div>
                                        <label class="ma" for="tutor_birthdate">ชื่อผู้ใช้งาน :</label>
                                        <input class="form-control" type="text" name="user_name"
                                            placeholder="ชื่อผู้ใช้งาน" value="{{ $users->name }}">

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="ma" for="tutor_birthdate">ชื่อ :</label>
                                            <input class="form-control" type="text" name="user_firstname"
                                                placeholder="ชื่อ" value="{{ $users->firstname }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="ma" for="tutor_birthdate">นามสกุล :</label>
                                            <input class="form-control" type="text" name="user_lastname"
                                                placeholder="นามสกุล" value="{{ $users->lastname }}">
                                        </div>
                                    </div>

                                    <div class="mp-2">
                                        <label class="ma" for="tutor_birthdate">ที่อยู่ :</label>
                                        <input type="text" name="user_address" class="form-control"
                                            placeholder="ที่อยู่" value="{{ $users->address }}">
                                    </div>
                                    <div>
                                        <label class="ma" for="tutor_birthdate">เบอร์โทร :</label>
                                        <input type="tel" class="form-control" name="user_tel"
                                            placeholder="เบอร์โทร" value="{{ $users->tel }}">
                                    </div>
                                    <div>
                                        <!-- <h7>วันเดือนปีเกิด :</h7> -->
                                        <label class="ma" for="tutor_birthdate">วันเดือนปีเกิด :</label>
                                        <!-- <label class="password-confirm" for="name">รหัสผ่าน 8 ตัวขึ้นไป</label> -->
                                        <input type="date" name="user_birthdate" class="form-control"
                                            placeholder="วันเดือนปีเกิด" value="{{ $users->birthdate }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2 mb-2">
                                <!-- <button type="submit" class="btn btn-danger">ยืนยัน</button> -->
                                <button type="submit" class="btn btn-success">ยืนยัน</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>



    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2023 Tutor Matching. All rights reserved.</p>
    </footer>


    <script>
        document.getElementById('fileInput').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    const imgElement = document.createElement('img');
                    imgElement.src = reader.result;
                    imgElement.style.width = '250px';
                    imgElement.style.height = '250px';


                    const currentImage = document.getElementById('Imgprofile');
                    currentImage.parentNode.replaceChild(imgElement, currentImage);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

    <script src="{{ asset('js/tutors/hometutor.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/profile.js') }}" defer></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>

</html>
