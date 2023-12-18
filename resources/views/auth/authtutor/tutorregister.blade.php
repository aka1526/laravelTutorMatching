@extends('layouts.loginTutor')
<style>
    .box-detail {
        background-color: rgba(255, 255, 255, 1);
        width: 100%;
        margin: auto;
        border-radius: 5px;
        margin-top: 2rem;
        padding: 2rem 6rem 1rem 6rem;
    }

    .form-group label {
        font-size: 20px;
        font-weight: bold;
    }

    .form-group input {
        margin-top: 0.5rem;
    }

    .form-group h6 {
        margin-top: 0.5rem;
    }

    .form-group button {
        border: none;
        background-color: #FFA800;
    }

    /* ----------------input file--------------- */
    .form-group label {
        font-weight: bold;
    }

    .text-center {
        margin-top: 50px;
    }
</style>

@section('content')
    <div class="text-center">
        <h1>สมัครติวเตอร์</h1>
    </div>


    <section>
        <div class="box-detail">
            <div class="container">
                <form method="POST" action="{{ route('tutor.register') }}" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputEmail-Password">อีเมลและรหัสผ่าน</label>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input id="name" class="form-control @error('tutor_name') is-invalid @enderror"
                                    type="text" name="tutor_name" value="{{ old('tutor_name') }}" required
                                    autocomplete="name" autofocus placeholder="ชื่อผู้ใช้">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="email" class="form-control @error('email') is-invalid @enderror"
                                    type="text" name="email" value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="อีเมล">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="password" class="form-control @error('password') is-invalid @enderror"
                                    type="password" name="password" required autocomplete="new-password"
                                    placeholder="รหัสผ่าน">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="password-confirm" class="form-control" type="password"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="ยืนยันรหัสผ่าน">


                                <hr>

                                <div class="form-group">
                                    <label for="personal-information">ข้อมูลส่วนตัว</label>

                                    <input id="tutor_firstname"
                                        class="form-control @error('tutor_firstname') is-invalid @enderror" type="text"
                                        name="tutor_firstname" required autocomplete="tutor_firstname" placeholder="ชื่อ"
                                        value="{{ old('tutor_firstname') }}">

                                    <input id="tutor_lastname"
                                        class="form-control @error('tutor_lastname') is-invalid @enderror" type="text"
                                        name="tutor_lastname" required autocomplete="tutor_lastname" placeholder="นามสกุล"
                                        value="{{ old('tutor_lastname') }}">

                                    {{-- <input list="gender-options" name="gender" id="gender" class="form-control"
                                        placeholder="เพศ">
                                    <datalist id="gender-options" value="{{ old('gender') }}">
                                        <option value="ชาย">
                                        <option value="หญิง">
                                        <option value="อื่นๆ">
                                    </datalist> --}}

                                    {{-- <label for="gender">เพศ</label> --}}
                                    <select id="gender" class="form-control mt-2" name="gender" required>
                                        <option>ระบุเพศ</option>
                                        <option value="ผู้ชาย">ชาย</option>
                                        <option value="ผู้หญิง">หญิง</option>
                                        <option value="อื่นๆ">อื่นๆ</option>
                                    </select>



                                    <input id="tutor_birthdate"
                                        class="form-control @error('tutor_birthdate') is-invalid @enderror" type="date"
                                        name="tutor_birthdate" required autocomplete="tutor_birthdate"
                                        placeholder="วัน/เดือน/ปีเกิด" value="{{ old('tutor_birthdate') }}">

                                    <input id="tutor_tel" class="form-control @error('tutor_tel') ไม่ถูกต้อง @enderror"
                                        type="text" name="tutor_tel" required autocomplete="tutor_tel"
                                        placeholder="เบอร์โทรศัพท์" value="{{ old('tutor_tel') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="education-level">ระดับการศึกษา</label>
                                <input id="info_tutor_education"
                                    class="form-control @error('info_tutor_education') is-invalid @enderror" type="text"
                                    name="info_tutor_education" required autocomplete="info_tutor_education"
                                    placeholder="ระดับการศึกษา" value="{{ old('info_tutor_education') }}">
                                <input id="info_tutor_univercity"
                                    class="form-control @error('info_tutor_univercity') is-invalid @enderror"
                                    type="text" name="info_tutor_univercity" required
                                    autocomplete="info_tutor_univercity" placeholder="มหาวิทยาลัย"
                                    value="{{ old('info_tutor_univercity') }}">
                                <input id="info_tutor_faculty"
                                    class="form-control @error('info_tutor_faculty') is-invalid @enderror" type="text"
                                    name="info_tutor_faculty" required autocomplete="info_tutor_faculty"
                                    placeholder="คณะ" value="{{ old('info_tutor_faculty') }}">
                                <input id="info_tutor_major"
                                    class="form-control @error('info_tutor_major') is-invalid @enderror" type="text"
                                    name="info_tutor_major" required autocomplete="info_tutor_major" placeholder="สาขา"
                                    value="{{ old('info_tutor_major') }}">
                                <input id="info_tutor_grade"
                                    class="form-control @error('info_tutor_grade') is-invalid @enderror" type="number"
                                    step="0.01" id="decimalInput" name="info_tutor_grade" required
                                    autocomplete="info_tutor_grade" placeholder="เกรดเฉลี่ย"
                                    value="{{ old('info_tutor_grade') }}">
                                <h6>ประวัติการศึกษาหรือเกียรติบัตร</h6>
                                <input type="file" class="form-control-file" name="info_tutor_certi" required>

                                <hr>
                            </div>

                            <div class="form-group">
                                <label for="Additional-information">ข้อมูลเพิ่มเติม</label>

                                <input id="info_tutor_location"
                                    class="form-control @error('info_tutor_location') is-invalid @enderror"
                                    type="text" name="info_tutor_location" required autocomplete="info_tutor_location"
                                    placeholder="สภานที่สอน" value="{{ old('info_tutor_location') }}">
                                <input id="info_tutor_exp"
                                    class="form-control @error('info_tutor_exp') is-invalid @enderror" type="number"
                                    name="info_tutor_exp" required autocomplete="info_tutor_exp" placeholder="ประสบการณ์"
                                    value="{{ old('info_tutor_exp') }}">

                                <h6>แนบบัตรประชาชน/บัตรนักศึกษา</h6>
                                <input type="file" class="form-control-file" name="file" required>


                            </div>
                        </div>
                    </div>
                    <div class="container text-center">
                        <button type="submit" class="btn btn-danger ">ยืนยันการสมัคร</button>
                        <div class="mt-2">
                            <a href="{{ route('tutor.login') }}" style="text-decoration: none"
                                class="text-decoration-none font-weight-normal text-reset">คุณมีบัญชีอยู่แล้ว?
                                เข้าสู่ระบบที่นี่.</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
@endsection
