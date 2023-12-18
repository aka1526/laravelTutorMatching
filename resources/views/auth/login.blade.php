@extends('layouts.login')
@section('content')
    <style>
        .gradient-custom-2 {
            background: #d8363a;
            font-family: "Chewy";
        }
        .mb-3.mt-2 {
            /* font-family: "Chewy"; */
            font: bold;
            color: rgb(97, 43, 43);

        }
        .link-light {
            text-decoration: none;
        }
        .text-center.link-home a {
            text-decoration: none;
            color: red;
            font-weight: bold;
            font-size: 20px;
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
                                        <h4 class="mb-3 mt-2">สำหรับนักเรียน</h4>
                                    </div>

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        @if ($message = Session::get('error'))
                                            <div class="alert alert-danger alert-block">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @endif


                                        <div class="form-outline mb-3">
                                            <label for="email">อีเมล</label>
                                            <input type="email" id="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                                placeholder="อีเมล" />

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-outline mb-4">
                                            <label for="password">รหัสผ่าน</label>
                                            <input type="password" id="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password" placeholder="รหัสผ่าน" />
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>



                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-danger btn-block fa-lg"
                                                type="submit">เข้าสู่ระบบ</button>
                                            @if (Route::has('password.request'))
                                                <a class="text-muted"
                                                    href="{{ route('password.request') }}">ลืมรหัสผ่าน?</a>
                                            @endif
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">คุณยังไม่มีบัญชี?</p>

                                            @if (Route::has('register'))
                                                <button type="button" class="btn btn-danger">
                                                    <a class="link-light" id="test"
                                                        href="{{ route('register') }}">สมัครสมาชิก</a>
                                                </button>
                                            @endif
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
