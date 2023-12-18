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
    </style>


</head>

<body>

    <body data-spy="scroll" data-target="#navbar" data-offset="72" class="position-relative">
        <header class="fixed-top page-header">
            <div class="container-fluid container-fluid-max">
                <nav id="navbar" class="navbar navbar-expand-lg navbar-dark">
                    <a class="navbar-brand" href="#home">TUTOR MATCHING</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-lg-between" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#process">TUTOR MATCHING</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#featured-destinations">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#popular-destinations">COUSE OFFERED</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#request-quote">TUTOR</a>
                            </li>
                        </ul>
                        <div class="text-white">
                            <a href="tel:1234567890" class="mr-2">
                                <i class="fas fa-phone"></i>
                                <div class="d-none d-xl-inline">1234567890</div>
                            </a>
                            <a href="mailto:info@honeydreams.com">
                                <i class="fas fa-envelope"></i>
                                <div class="d-none d-xl-inline">info@honeydreams.com</div>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <main>
            <section id="home" class="d-flex align-items-center position-relative vh-100 cover hero"
                style="background-image:url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/cappadocia.jpg);">
                <div class="container-fluid container-fluid-max">
                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <h1 class="text-white">WELLCOME TO WEBSITE TUTOR MATCHING</h1>
                            <div class="mt-3">
                                <a class="btn bg-red text-white mr-2" href="" role="button">Book Now</a>
                                <a class="btn bg-red text-white" href="" role="button">Select Your Package</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="process" class="process">
                <div class="container-fluid container-fluid-max">
                    <div class="row text-center py-5">
                        <div class="col-12 pb-4">
                            <h2 class="text-red">COUSE OFFERED</h2>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x text-red"></i>
                                <i class="fa-solid fa-pencil"></i>
                                <i class="fa-regular fa-pen-to-square fa-stack-1x text-white"></i>
                            </span>
                            <h3>
                                <a class="mt-3 text-red h4 " href="#home">MATCHING</a>
                            </h3>

                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed repudiandae.</p>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x text-red"></i>
                                <i class="fa-solid fa-atom text-white"></i>

                            </span>
                            <h3>
                                <a class="mt-3 text-red h4 " href="#home">PHYSICS</a>
                            </h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed repudiandae.</p>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x text-red"></i>
                                <i class="fas fa-car fa-stack-1x text-white"></i>
                            </span>
                            <h3>
                                <a class="mt-3 text-red h4 " href="#home">BIOLOGY</a>
                            </h3>
                            <p>Nor again is there anyone who loves or pursues or desires to obtain pain.</p>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x text-red"></i>
                                <i class="fas fa-home fa-stack-1x text-white"></i>
                            </span>
                            <h3>
                                <a class="mt-3 text-red h4 " href="#home">CHEMIMSRTY</a>
                            </h3>
                            <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam,
                                nisi ut aliquid ex ea commodi.</p>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x text-red"></i>
                                <i class="fas fa-home fa-stack-1x text-white"></i>
                            </span>
                            <h3>
                                <a class="mt-3 text-red h4 " href="#home">ENGLISH</a>
                            </h3>
                            <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam,
                                nisi ut aliquid ex ea commodi.</p>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-3">
                            <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x text-red"></i>
                                <i class="fas fa-home fa-stack-1x text-white"></i>
                            </span>
                            <h3>
                                <a class="mt-3 text-red h4 " href="#home">FRENCH</a>
                            </h3>
                            <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam,
                                nisi ut aliquid ex ea commodi.</p>
                        </div>


                        <div class="col-12 col-sm-6 col-lg-3">
                            <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x text-red"></i>
                                <i class="fas fa-home fa-stack-1x text-white"></i>
                            </span>
                            <h3>
                                <a class="mt-3 text-red h4 " href="#home">CHINESE</a>
                            </h3>
                            <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam,
                                nisi ut aliquid ex ea commodi.</p>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-3">
                            <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x text-red"></i>
                                <i class="fas fa-home fa-stack-1x text-white"></i>
                            </span>
                            <h3>
                                <a class="mt-3 text-red h4 " href="#home">TECHNOLOGY</a>
                            </h3>
                            <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam,
                                nisi ut aliquid ex ea commodi.</p>
                        </div>
                        <div class="col-12 pt-3">
                            <a class="btn bg-red text-white" target="_blank"
                                href="https://en.wikipedia.org/wiki/Neuschwanstein_Castle" role="button">Learn More
                                →</a>
                        </div>
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

                                <!-- Swiper -->
                            

                                @foreach ($tutors as $tutor)
                                <div class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="card bg-red" style="width: 18rem;">
                                                {{-- <img width="100%" src="{{ url("storage/news/{$tutor->$info_tutor_img}") }}"
                                                    class="card-img-top" alt=""> --}}
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $tutor->tutor_firstname }} {{ $tutor->tutor_lastname }} </h5>
                                                    <p class="card-text">จบจากมหาวิทยาลัยระดับโลก และได้รับเหรียญทองโอลิมปิก</p>
                                                    <a href="{{ url('/') }}" class="btn btn-light">see
                                                        details</a>
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
