@extends('layouts.login')

@section('content')
    <style>
        .mb-3.mt-2 {
            /* font-family: "Chewy"; */
            font: bold;
            color: rgb(97, 43, 43);

        }

        .text-center.regis {
            color: rgb(97, 43, 43);
        }

        .link-light {
            text-decoration: none;
        }

        .password-confirm {
            font-size: 10px;
            color: rgb(127, 127, 127)
        }

        .text-center.link-home a {
            text-decoration: none;
            color: red;
            font-weight: bold;
            font-size: 20px;
        }


        .text-center a {
            text-decoration: none;
            color: rgb(3, 1, 1)
        }
    </style>

    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-4">
                    <div class="card rounded-3 text-black">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body mx-md-10">
                                    <div class="text-center">
                                        <img src="/storage/img/11.png" width="100px" height="100px" alt="logo">
                                        <h2 class="mb-3 mt-2">Tutor Matching</h2>
                                    </div>

                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <h5 class="text-center regis">สมัครสมาชิก</h5>
                                        <div class="form-group mb-3">
                                        
                                            <input id="name" class="form-control @error('name') is-invalid @enderror"
                                                type="text"name="name" value="{{ old('name') }}" required
                                                autocomplete="name" autofocus placeholder="ชื่อผู้ใช้">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            
                                            <input id="email" class="form-control @error('email') is-invalid @enderror"
                                                type="email" name="email" value="{{ old('email') }}" required
                                                autocomplete="email" placeholder="อีเมล">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <div class="form-group col-6">
                                                {{-- <label for="name">อีเมลล์</label> --}}
                                                <input id="email"
                                                    class="form-control @error('firstname') is-invalid @enderror" type="text"
                                                    name="firstname" value="{{ old('firstname') }}" required
                                                    autocomplete="email" placeholder="ชื่อ">
                                                @error('firstname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6 ">
                                                {{-- <label for="name">อีเมลล์</label> --}}
                                                <input id="email"
                                                    class="form-control @error('lastname') is-invalid @enderror" type="text"
                                                    name="lastname" value="{{ old('lastname') }}" required
                                                    autocomplete="lastname" placeholder="นามสกุล">
                                                @error('lastname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            {{-- <label for="name">รหัสผ่าน</label> --}}
                                            <input id="password"
                                                class="form-control @error('password') is-invalid @enderror" type="password"
                                                name="password" required autocomplete="new-password" placeholder="รหัสผ่าน">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="password-confirm" for="name">รหัสผ่าน 8 ตัวขึ้นไป</label>
                                            <input id="password-confirm" class="form-control" type="password"
                                                name="password_confirmation" required autocomplete="new-password"
                                                placeholder="ยืนยันรหัสผ่าน">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <div class="form-group mb-3">
                                                <button class="btn btn-danger btn-block" type="submit">สมัครสมาชิก</button>
                                            </div>
                                        </div>
                                        <div class="text-center mt-2">
                                            <a href="{{ route('login') }}" class="already">คุณมีบัญชีอยู่แล้ว?
                                                เข้าสู่ระบบที่นี่</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="text-center link-home">
        <a href="{{ url('/') }}">กลับสู่หน้าแรก</a>
    </div>
@endsection
