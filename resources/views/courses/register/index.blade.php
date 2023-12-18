<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TUTORMATCHING') }}TUTOR-MATCHING</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
     <!-- SweetAlert2 CDN links -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
    <title>Laravel</title>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        .navbar-scroll .nav-link,
        .navbar-scroll .fa-bars,
        .navbar-scroll .navar-brand {
            color: #4f4f4f;
        }

        .navbar-scroll .nav-link:hover {
            color: #1266f1;
        }

        /* Color of the links AFTER scroll */
        .navbar-scrolled .nav-link,
        .navbar-scrolled .fa-bars,
        .navbar-scrolled .navar-brand {
            color: #4f4f4f;
        }

        /* Color of the navbar AFTER scroll */
        .navbar-scroll,
        .navbar-scrolled {
            background-color: #fff;
        }

        /* An optional height of the navbar AFTER scroll */
        .navbar.navbar-scroll.navbar-scrolled {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        body {
            background-color: #eee;
        }


        /* --------------------------------------------------------------------------------- */
        * {
            margin: 0;
            padding: 0;
            font-family: 'Kanit', sans-serif;
        }

        .portfolio {
            margin-top: 1rem;
        }

        .subj {
            margin-top: 2rem;
        }

        .col1 img {
            width: 20rem;
            margin: auto auto;
            display: block;
            border-radius: 10px;

        }

        .subj button {
            padding: 0.3rem;
            border: none;
            background-color: brown;
            color: white;
            border-radius: 5px;
        }

        .container-port {
            margin: 10%;


        }

        .col-6 h2 {
            margin-top: 5%;
            margin-bottom: 5%
        }

        .goshop {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2.5rem 0;
        }

        .swiper-slide img {
            object-fit: cover;
            height: 196px;
        }

        .swiper-slide .card {
            border-color: var(--bs-primary-border-subtle);
        }

        .swiper-button-next,
        .swiper-button-prev {
            background-color: #ffffff;
            border-radius: 50%;
            width: var(--swiper-navigation-size);
            height: var(--swiper-navigation-size);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 1.5rem;
        }

        .text-red {
            color: red;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-scroll">
        <div class="container">
            <img src="{{ url('storage/img/11.png') }}" height="70" alt="" loading="lazy" />
            <a class="navbar-brand" href="{{ url('/home') }}">TUTOR MATCHING</a>
            <button class="navbar-toggler ps-0" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon d-flex justify-content-start align-items-center">
                    <i class="fas fa-bars"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarExample01">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/courses') }}">วิชาที่เปิดสอน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/home') }}">แชท</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/promoteTutor') }}">โปรโมต</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ------------------------------------------------------------------------------------- -->
    {{-- Tutor','Course --}}
    <div class="py-4">
        <div class="container-port">
            @if(session()->get('dataarray'))
            @php
                $data = session()->get('dataarray');
                $icon = $data['icon'] ?? 'success';
                $msg = $data['msg'] ?? 'ลบสำเร็จ';
                $result = $data['result'] ?? 'success';
                $reg_no = $data['reg_no']  ;

            @endphp
    <script>

        Swal.fire({
                icon: '{{ $icon }}',
                title: '{{ $msg }}',
                text: 'เลขที่ลงทะเบียน {{ $reg_no }}',
                timer: 1500,
            }).then(() => {
                location.reload();
            });
    </script>


            @endif
            <div class="row ">
                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-red"><b>คอร์สเรียน {{ $Course->course_name }}</b></h2>
                        </div>
                        <div class="col-12">

                                <img src="/storage/{{ $Course->course_img }}" style="max-width: 95%;" height="400vh" class="card-img-top" alt="Course Image">

                        </div>

                    </div>



                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-red"><b>ชำระค่าลงทะเบียน {{ number_format($Course->course_price,0) }} บาท</b></h2>
                        </div>

                        <div class="col-md-12">
                            <form id="frmregister" name="frmregister" action="{{ route('reg.save') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="course_id"  name="course_id" value="{{ $Course->id}}" >
                                <div class="mb-3 col-6">
                                    <label for="date_start" class="form-label">เลือกวันที่ต้องการเรียน</label>
                                    <input type="date" class="form-control" id="date_start" name="date_start" placeholder="วันที่" {{ $CountRegister ? 'disabled ' : ' required' }}>
                                  </div>

                                <h3>กรุณาโอนเงิน และแนบเอกสารการชำระเงิน</h3>
                                <div class="input-group mb-3">
                                <input type="file" class="form-control" id="filepayment" name="filepayment" {{ $CountRegister>0 ? 'disabled' : 'required' }} >

                              </div>
                              <div class="col-12">

                                @if($CountRegister)
                                <button type="button" class="btn btn-secondary">คุณได้ลงทะเบียน เรียบร้อยแล้ว</button>
                                @else
                                <button type="summit" class="btn btn-danger"><i class="fa fa-graduation-cap"></i> ลงทะเบียน</button>
                                @endif

                                <a href="/" class="btn btn-primary"><i class="fa fa-arrow-left"></i> กลับหน้าหลัก</a>

                            </div>
                         </form>
                        </div>
                        <div class="col-12">
                            <h2 class="text-primary"><b> ช่องทางชำระเงิน</b></h2>
                            <p> โอนผ่านธนาคาร (Bank Transfer)</p>
                             <h3><img src="/img/bank/scb.png"> ธนาคารไทยพาณิชย์</h3>
                             <h3>เลขบัญชี: 010-999-999</h3>
                             <h3>บัญชีประเภท: ออมทรัพย์</h3>
                             <h3>ชื่อบัญชี: TUTOR MATCHING</h3>


                        </div>
                    </div>

                </div>
            </div>


            <div class="row row-main">
                        <!-- <strong>ขอบเขต</strong>
                <textarea type="text" name="news_detail" class="form-control" placeholder="ขอบเขตการสอน"></textarea>
                @error('news_detail')
            <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div> -->

            </div>

        </div>

    </div>
</body>
<script>

</script>
</html>
