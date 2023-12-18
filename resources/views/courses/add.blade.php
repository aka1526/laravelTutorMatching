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

    <div class="py-4">
        <div class="container-port">

            <div class="row text-center py-1">
                <div class="col-12 pb-2">
                    <h2 class="text-red"><b>เพิ่มรายวิชา</b></h2>
                </div>
            </div>
            <div class="row row-main">
                <strong>ข้อมูลวิชา</strong>
                <div class="col-lg-5 col-md-12 col-sm-12 col1">
                    <strong>รูปวิชา</strong>

                    <input type="file" name="news_img" class="form-control" placeholder="รูปวิชา">
                    @error('news_img')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                        <!-- <div class="col-lg-6 col-md-12 col-sm-12">
                        <h2>ประวัติ</h2>
                        <hr>
                        <h3></h3>
                        <div class="subj">
                            <h6>วิชาที่สอน</h6>
                            <button>เลข</button>
                            <br> <br>
                            <h6>ระดับที่สอน</h6>
                            <button>ม.ปลาย</button>
                        </div>
                        <div class="portfolio">
                            <ul>
                                <li>1</li>
                                <li>2</li>
                                <li>3</li>
                            </ul>
                        </div>
                    </div> -->

                <div class="col-md-12">
                    <div class="form-group my-2">
                        <!-- <strong>ชื่อหลักสูตร</strong> -->
                        <input type="tel" name="news_tel" class="form-control" placeholder="ชื่อวิชา">
                        @error('news_tel')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>



                <div class="col-md-12">
                    <div class="form-group my-2">
                        <strong>ข้อมูลวิชา</strong>
                        <textarea type="text" name="news_detail" class="form-control" placeholder="ข้อมูลวิชา"></textarea>
                        @error('news_detail')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group my-2">
                        <textarea type="text" name="news_detail" class="form-control" placeholder="ระยะเวลาที่สอน"></textarea>
                        @error('news_detail')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group my-2">
                        <textarea type="text" name="news_detail" class="form-control" placeholder="ระดับชั้น"></textarea>
                        @error('news_detail')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="row row-main">
                <strong>รูปแบบการสอน</strong>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">การสอนแบบตัวต่อตัว </label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">การสอนแบบกลุ่ม (4-6 คน)</label>
                </div>


                                <!-- <strong>ขอบเขต</strong>
                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <textarea type="text" name="news_detail" class="form-control" placeholder="ขอบเขตการสอน"></textarea>
                            @error('news_detail')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                        </div>
                    </div> -->

                <strong>เป้าหมาย</strong>
                <div class="col-md-6">
                    <div class="form-group my-2">
                        <textarea type="text" name="news_detail" class="form-control"
                            placeholder="เป้าหมายของวิชา เช่น การสอนเพื่อสอบเข้ามหาวิทบสลัย"></textarea>
                        @error('news_detail')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="text">
                <a href="{{ url('/courses') }}" class="btn btn-warning">ย้อนกลับ</a>
                <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
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

</html>
