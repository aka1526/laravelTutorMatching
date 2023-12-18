<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>TUTOR-MATCHING</title>


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet'>

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

    <div class="container-port">
        <div class="row">
            <div class="col-md-3 col-sm-12 mb-4" id="container_profile_1">
                <form action="/tutor/profile/{id}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="fileInput" id="imgLabel">
                            <h3>รูปโปรไฟล์</h3>
                            <img src="{{ url("storage/{$tutors->tutor_img}") }}" class="mt-3" id="Imgprofile"
                                style="cursor: pointer; width: 250px; height: 250px;" alt="Profile Image">
                        </label>
                        <input type="file" class="form-control" name="tutor_img" id="fileInput"
                            style="display: none;">
                        <div class="button-container mt-2 d-flex justify-content-center">
                            <button type="button" class="btn btn-primary"
                                onclick="document.getElementById('fileInput').click();">เปลี่ยนรูปภาพ</button>
                        </div>
                    </div>
                    <div class="button-container mt-1 d-flex justify-content-center">
                        <button type="submit" id="btnSubmit" class="btn btn-danger">อัพโหลด</button>
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
                        <div class="profile_content">
                            <div class="name">
                                <b>ชื่อผู้ใช้</b> <b class="form-control">{{ $tutors->tutor_name }}</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row" id="info">
                            <div class="col-6">
                                <h5><b>ข้อมูลส่วนตัว</b></h5>
                                <div class="form-control">ชื่อ {{ $tutors->tutor_firstname }}
                                    {{ $tutors->tutor_lastname }}</div>
                                <div class="form-control">วันเดือนปีเกิด {{ $tutors->tutor_birthdate }}</div>
                            </div>

                            <div class="col-6" id="contact">
                                <h5><b>การติดต่อ</b></h5>
                                <div class="form-control">เบอร์โทร {{ $tutors->tutor_tel }}</div>
                                <div class="form-control">อีเมลล์ {{ $tutors->email }}</div>
                                <div class="form-control">ที่อยู่ {{ $tutors->tutor_address }}</div>
                            </div>
                            <hr>
                        </div>

                        <h5><b>ประวัติการศึกษา</b></h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-control">{{ $tutors->infotutor->info_tutor_education }}</div>
                                <div class="form-control">{{ $tutors->infotutor->info_tutor_faculty }}</div>
                                <div class="form-control">{{ $tutors->infotutor->info_tutor_major }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-control">{{ $tutors->infotutor->info_tutor_univercity }}</div>
                                <div class="form-control">{{ $tutors->infotutor->info_tutor_grade }}</div>
                                <div class="form-control">{{ $tutors->infotutor->info_tutor_univercity }}</div>
                                {{-- <div class="form-control">{{ $tutors->infotutor->info_tutor_location }}</div> --}}
                                {{-- <div class="form-control">{{ $tutors->infotutor->info_tutor_exp }}</div> --}}
                            </div>
                        </div>
                        <hr>
                        <div class="profile_content">
                            <div class="name">
                                <b>Line Notify Token</b> (<a href="https://notify-bot.line.me/en/">สมัคร Line Notify</a>) <b class="form-control">{{ $tutors->line_token !=''  ? $tutors->line_token : 'No Token Key'; }}</b>
                            </div>
                        </div>



                    </div>

                    <div id="sub-page" style="display:none;">
                        <h6><b>แก้ไขโปรไฟล์</b></h6>
                        <form action="{{ route('tutor.edit.profile', ['id' => $tutors->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                    <label class="ma" for="name">ชื่อผู้ใช้งาน :</label>
                                        <input type="file" class="form-control" name="tutor_img" id="fileInput"
                                            value="{{ $tutors->tutor_img }}" style="display: none;" hidden>
                                        <input class="form-control" type="text" name="tutor_name"
                                            placeholder="ชื่อผู้ใช้งาน" value="{{ $tutors->tutor_name }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                        <label class="ma" for="name">ชื่อ :</label>
                                            <input class="form-control" type="text" name="tutor_firstname"
                                                placeholder="ชื่อ" value="{{ $tutors->tutor_firstname }}">
                                        </div>
                                        <div class="col-md-6">
                                        <label class="ma" for="name">นามสกุล :</label>
                                            <input class="form-control" type="text" name="tutor_lastname"
                                                placeholder="นามสกุล" value="{{ $tutors->tutor_lastname }}">
                                        </div>
                                    </div>
                                    <div>
                                    <label class="ma" for="name">อีเมล :</label>
                                        <input type="email" name="tutor_email" class="form-control"
                                            placeholder="อีเมล" value="{{ $tutors->email }}">
                                    </div>
                                    <div>
                                    <label class="ma" for="name">ทีอยู่ :</label>
                                        <input type="text" name="tutor_address" class="form-control"
                                            placeholder="ทีอยู่" value="{{ $tutors->tutor_address }}">
                                    </div>
                                    <div>
                                    <label class="ma" for="name">เบอร์โทร :</label>
                                        <input type="tel" class="form-control" name="tutor_tel"
                                            placeholder="เบอร์โทร" value="{{ $tutors->tutor_tel }}">
                                    </div>
                                    <div>
                                    <!-- <strong>วันเดือนปีเกิด :</strong> -->
                                    <label class="ma" for="name">วันเดือนปีเกิด :</label>
                                        <input type="date" name="tutor_birthdate" class="form-control"
                                            placeholder="วันเดือนปีเกิด" value="{{ $tutors->tutor_birthdate }}">
                                    </div>
                                </div>

                        <div class="profile_content">
                            <div class="name">
                                <label class="ma" for="line_token">Line Notify Token (<a href="https://notify-bot.line.me/en/">สมัคร Line Notify</a>):</label>
                                <input type="text" id="line_token" name="line_token" class="form-control"
                                    placeholder="Token" value="{{ $tutors->line_token }}">
                            </div>

                        </div>
                            </div>
                            <div class="mt-2 mb-2">
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
