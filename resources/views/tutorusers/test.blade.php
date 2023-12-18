<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TUTORMATCHING') }}</title>
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

    <!-- Fonts -->
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        /* RESET RULES & HELPER CLASSES
            –––––––––––––––––––––––––––––––––––––––––––––––––– */
        :root {
            --lightblue: #f6f9fc;
            --red: #d64041;
        }

        a,
        a:hover {
            color: inherit;
        }

        a:hover {
            text-decoration: none;
        }

        .bg-lightblue {
            background: var(--lightblue);
        }

        .bg-red {
            background: var(--red);
        }

        .text-red {
            color: var(--red);
        }

        .container-fluid-max {
            max-width: 1440px;
        }

        .cover {
            background: no-repeat center/cover;
        }

        .p-15 {
            padding: 15px;
        }

        /* SCROLL ANIMATIONS
            –––––––––––––––––––––––––––––––––––––––––––––––––– */
        .scroll .page-header {
            background: var(--red);
        }

        .scroll .hero {
            transform: scale(0.98);
        }

        /* HEADER
            –––––––––––––––––––––––––––––––––––––––––––––––––– */
        .page-header {
            transition: background 0.5s ease-in-out;
        }

        .page-header .navbar {
            padding: 1rem 0;
        }

        .page-header .navbar-toggler {
            /* the variable is inherited from BS4 built-in variables */
            border-color: var(--white);
        }

        /* BANNER SECTION
            –––––––––––––––––––––––––––––––––––––––––––––––––– */
        .hero {
            background-attachment: fixed;
            transition: transform 0.5s ease-in-out;
        }

        .hero::after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: linear-gradient(rgba(0, 0, 0, 0.5) 0,
                    rgba(0, 0, 0, 0.3) 50%,
                    rgba(0, 0, 0, 0.1) 100%);
        }

        .hero .container-fluid {
            z-index: 10;
        }

        /* POPULAR DESTINATIONS SECTION
            –––––––––––––––––––––––––––––––––––––––––––––––––– */
        .popular-destinations figure {
            margin-bottom: 30px;
        }

        .popular-destinations figcaption {
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.3);
        }

        .popular-destinations img {
            filter: grayscale(100%) blur(3px);
            transition: transform 0.5s, filter 0.75s;
        }

        .popular-destinations a:hover img {
            transform: scale(1.25);
            filter: none;
        }

        /* PAGE FOOTER
            –––––––––––––––––––––––––––––––––––––––––––––––––– */
        .page-footer .footer-links {
            text-align: right;
        }

        .container {
            position: relative;
            margin-top: 10%;
            left: 0;
            bottom: 0;
            right: 0;
            border: none;
            overflow: hidden;
            background: #d64041;
            width: 10%;
            height: 10%;
            padding-top: 56.25%;
            /* 16:9 Aspect Ratio */
        }

        .swiper-button-next,
        .swiper-button-prev {
            background-color: #ffffff;
            border-radius: 50%;
            width: var(--swiper-navigation-size);
            height: var(--swiper-navigation-size);
        }

        /* .responsive-iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 50%;
            height: 50%;
            border: none;
            } */



        /* MEDIA QUERIES
            –––––––––––––––––––––––––––––––––––––––––––––––––– */
        /* MEDIUM SCREENS */
        @media screen and (max-width: 991px) {
            .page-header {
                background: var(--red);
            }
        }

        /* SMALL SCREENS */
        @media screen and (max-width: 767px) {
            .page-footer .footer-child {
                text-align: center;
            }
        }

        /* --Slide--- */
        .swiper-slide .swiper {
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

            width: var(--swiper-navigation-size);
            height: var(--swiper-navigation-size);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 1.5rem;
        }

        .navbar {
            text-decoration: black;
        }
    </style>


</head>

<body>

    <body data-spy="scroll" data-target="#navbar" data-offset="72" class="position-relative">
        <header class="fixed-top page-header">
            <div class="container-fluid container-fluid-max">
                <nav id="navbar" class="navbar navbar-expand-lg body-tertiary navbar-dark">
                    <a class="navbar-brand" href="{{ url('/') }}">TUTOR MATCHING</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="dropdown" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-lg-between" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#home">TUTOR</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="#home">HOME</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" href="#process">COURSES</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="#featured-destinations">TUTOR</a>
                            </li> --}}
                        </ul>

                        <ul class="navbar-nav mx-2">
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
                                        {{ Auth::user()->name }}
                                    </a>


                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                                        <form method="POST">
                                            <a class="dropdown-item" href="{{ url('/profile') }}">Profile</a>
                                            @csrf
                                        </form>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>


                                </li>
                            @endguest
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <main>
            <section id="home" class="d-flex align-items-center position-relative vh-100 cover hero"
                style="background-image:url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/cappadocia.jpg);">

                <div class="container-fluid container-fluid-max">
                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-3">
                            <h1 class="text-white">WELLCOME TO TUTOR MATCHING</h1>
                            {{-- <div class="mt-3">
                                <a class="btn bg-red text-white mr-2" href="" role="button">Book Now</a>
                                <a class="btn bg-red text-white" href="" role="button">Select Your Package</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </section>


            {{-- courses --}}

            <section id="process" class="process">
                <div class="container-fluid container-fluid-max">
                    <div class="row text-center py-5">
                        <div class="col-12 pb-4">
                            <h2 class="text-red">COURSES</h2>
                        </div>
                        <div class="container-main">
                            <div class="pt-5">

                                <!-- Swiper -->

                                
                                <div class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="card " style="width: 18rem;">
                                                <img width="100%" src="{{ url('https://www.cututoronline.com/uploads/course_terbo/20220515193153-4087.jpg') }}"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">คอร์สเข้าสอบมหวาวิยาลัย A-lavel</h5>
                                                    <p class="card-text">Some quick example text to build on the card
                                                        title and make up the
                                                        bulk
                                                        of the card's content.</p>
                                                    <a href="{{ url('/') }}" class="btn btn-danger">see
                                                        details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="card " style="width: 18rem; border: rgb(252, 251, 252);">
                                                <img width="150px" src="{{ url('https://www.che-me-ka.com:8443/uploads/1644154016338-00-11.jpeg') }}"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">Some quick example text to build on the card
                                                        title and make up the
                                                        bulk
                                                        of the card's content.</p>
                                                    <a href="{{ url('/reviews1') }}" class="btn btn-danger">see
                                                        details</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <div class="card " style="width: 18rem; border: rgb(252, 251, 252);">
                                                <img width="150px" src="{{ url('https://www.ondemand.in.th/wp-content/uploads/2021/10/Thumbnails-%E0%B8%84%E0%B8%AD%E0%B8%A3%E0%B9%8C%E0%B8%AA%E0%B9%81%E0%B8%A2%E0%B8%81%E0%B8%A3%E0%B8%B2%E0%B8%A2%E0%B8%A7%E0%B8%B4%E0%B8%8A%E0%B8%B2_Physics_%E0%B8%84%E0%B8%93%E0%B8%B4%E0%B8%95%E0%B8%AF-%E0%B8%AA%E0%B8%B2%E0%B8%A1%E0%B8%B1%E0%B8%8D-1024x536.jpg') }}"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">Some quick example text to build on the card
                                                        title and make up the
                                                        bulk
                                                        of the card's content.</p>
                                                    <a href="#" class="btn btn-danger">see details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="card " style="width: 18rem; border: rgb(0, 0, 0);">
                                                <img width="150px" src="{{ url('https://www.ondemand.in.th/wp-content/uploads/elementor/thumbs/95657247_3285770661456598_4552297615839985664_o-q2d7okstdl0li598z4r1fl7orwns20eg04x7t8xyfc.png') }}"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">Some quick example text to build on the card
                                                        title and make up the
                                                        bulk
                                                        of the card's content.</p>
                                                    <a href="#" class="btn btn-danger">see details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="card " style="width: 18rem; border: rgb(252, 251, 252);">
                                                <img width="150px" src="{{ url('https://inwfile.com/s-ck/9hp7x7.jpg') }}"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">Some quick example text to build on the card
                                                        title and make up the
                                                        bulk
                                                        of the card's content.</p>
                                                    <a href="#" class="btn btn-danger">see details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="card " style="width: 18rem; border: rgb(0, 0, 0);">
                                                <img width="150px" src="{{ url('https://resource.skilllane.com/courses/share_thumbnails/000/001/397/original/1397_%E0%B8%A0%E0%B8%B2%E0%B8%A9%E0%B8%B2%E0%B8%88%E0%B8%B5%E0%B8%99%E0%B8%9E%E0%B8%B7%E0%B9%89%E0%B8%99%E0%B8%90%E0%B8%B2%E0%B8%99%E0%B8%AA%E0%B8%B3%E0%B8%AB%E0%B8%A3%E0%B8%B1%E0%B8%9A%E0%B8%9C%E0%B8%B9%E0%B9%89%E0%B9%80%E0%B8%A3%E0%B8%B4%E0%B9%88%E0%B8%A1%E0%B9%80%E0%B8%A3%E0%B8%B5%E0%B8%A2%E0%B8%99_5._1200x630.jpg') }}"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">Some quick example text to build on the card
                                                        title and make up the
                                                        bulk
                                                        of the card's content.</p>
                                                    <a href="{{ url('/reviews') }}" class="btn btn-danger">see
                                                        details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-button-next shadow"></div>
                                    <div class="swiper-button-prev shadow"></div>
                                    <div class="swiper-pagination"></div>

                                </div>
                            </div>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
                            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
                        </script>
                        <!-- Swiper JS -->
                        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
                        <!-- Initialize Swiper -->
                        <script>
                            var swiper = new Swiper(".mySwiper", {
                                slidesPerView: 1,
                                spaceBetween: 20,
                                pagination: {
                                    el: ".swiper-pagination",
                                    dynamicBullets: true,
                                },
                                navigation: {
                                    nextEl: ".swiper-button-next",
                                    prevEl: ".swiper-button-prev",
                                },
                                breakpoints: {
                                    768: {
                                        slidesPerView: 2
                                    },
                                    1024: {
                                        slidesPerView: 4
                                    },
                                },
                            });
                        </script>
                    </div>

                </div>
            </section>

            <section id="featured-destinations" class="featured-destinations bg-lightblue">

                <div class="row no-gutters">


                    <div class="container-fluid container-fluid-max">

                        <div class="row text-center py-4">
                            <div class="col-12 pb-8">
                                <h2 class="text-red">BEST TUTOR TEAM </h2>
                            </div>
                        </div>

                        <!-- <div class="container"> -->

                        <div class="container-main">
                            <div class="pt-5">

                                @foreach ($tutors as $tutor)
    
                                <!-- Swiper -->
                                <div class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="card " style="width: 18rem;">
                                                <img width="100%" height="100px" src="{{ url("storage/news/{$tutor->infotutor->info_tutor_img}") }}" />
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$tutor->tutor_firstname}} {{$tutor->tutor_lastname}}</h5>
                                                    <p class="card-text">ระดับการศึกษา {{$tutor->infotutor->info_tutor_education}} จบจาก {{$tutor->infotutor->info_tutor_univercity}} 
                                                        คณะ {{$tutor->infotutor->info_tutor_faculty}} สาขา {{$tutor->infotutor->info_tutor_major}}
                                                        ประสบการ์ณสอน {{$tutor->infotutor->info_tutor_exp}} ปี</p>
                                                        <a href="{{ url('/tutor'.'/'.$tutor->tutor_id.'/reviews') }}" class="btn btn-danger">See details</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="swiper-button-next shadow"></div>
                                    <div class="swiper-button-prev shadow"></div>
                                    <div class="swiper-pagination"></div>

                                </div>
                                
                                @endforeach

                            </div>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
                            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
                        </script>
                        <!-- Swiper JS -->
                        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
                        <!-- Initialize Swiper -->
                        <script>
                            var swiper = new Swiper(".mySwiper", {
                                slidesPerView: 1,
                                spaceBetween: 20,
                                pagination: {
                                    el: ".swiper-pagination",
                                    dynamicBullets: true,
                                },
                                navigation: {
                                    nextEl: ".swiper-button-next",
                                    prevEl: ".swiper-button-prev",
                                },
                                breakpoints: {
                                    768: {
                                        slidesPerView: 2
                                    },
                                    1024: {
                                        slidesPerView: 4
                                    },
                                },
                            });
                        </script>
                        <!-- </div> -->
                        <!-- ---------------------------------- -->
                    </div>
                </div>
                </div>
            </section>





    </body>

</html>
