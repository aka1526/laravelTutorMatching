@extends('layouts.adminsidebar')

<link rel="stylesheet" href="{{ asset('css/admincss/home.css') }}">
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{ url('/admin') }}">Home</a></li>
        </ol>
    </nav>
@endsection

@section('dashboard')
    <div class="container mb-4 mt-4">
        <h1 class="h2"><b>แดชบอร์ด</b></h1>

        {{-- ------------cardddddddddd---------------- --}}
        <div class="container text-center mt-2">
            <div class="row">
                <div class="col-xl-3 col-md-3">
                    <div class="card bg-danger text-white ">
                        <div class="card-body">ติวเตอร์ทั้งหมด
                            <h2>{{ $tutors_count }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3">
                    <div class="card bg-danger text-white ">
                        <div class="card-body">ผู้ใช้ทั้งหมด
                            <h2>{{ $users_count }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3">
                    <div class="card bg-danger text-white ">
                        <div class="card-body">แอดมินทั้งหมด
                            <h2>{{ $admins_count }}</h2>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-md-3">
                    <div class="card text-white " id="timedisplay">
                        <div class="card-body">Time
                            <h2>
                                <div class="time-display" id="current-time"></div>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{-- ------------------------------- --}}

        <div class="row">
            <div class="col-md-8">
                <div class="container">
                    <table class="table table-dark table-hover table-borderless">
                        <tr id="tableHead">
                            <th class="table-dark text-center">ชื่อ</th>
                            <th class="table-dark text-center">วันที่สมัคร</th>
                            <th class="table-dark text-center">สถานะ</th>
                        </tr>
                        @foreach ($tutors as $tutor)
                            <tr>
                                <td class="text-left ml-1">
                                    <div class="d-flex justify-content-left align-items-left">
                                        <div class="rounded-circle" style="width: 35px; height: 35px; overflow: hidden;">
                                            <img src="{{ url("storage/{$tutor->tutor_img}") }}" alt="Tutor Image"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <div class="mp-1"> {{ $tutor->tutor_firstname }} {{ $tutor->tutor_lastname }}</div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $tutor->created_at }}</td>
                                <td class="text-center">
                                    @if ($tutor->is_tutor === 1)
                                        <span class="badge badge-success custom-badge">อนุมัติแล้ว</span>
                                    @else
                                        <span class="badge badge-danger custom-badge">รอการอนุมัติ</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>


                </div>
            </div>
            <div class="col-md-4 mt-4">
                <div id="imageContainer" class="card-img-top" style="position: relative;">
                    @foreach ($news as $new)
                        <img src="{{ url("storage/{$new->news_img}") }}" style="width: 100%;">
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container mt-2">
            <div class="card" id="card">
                <div class="card-header bg-dark text-white rounded-top">
                    <h5 class="card-title">Top Tutors by Rating</h5>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        @foreach ($averageRatings as $averageRating)
                            <div class="col-4 mb-4">
                                <div class="podium-rank text-center position-relative">
                                    <img src="{{ url("storage/{$averageRating->tutor->tutor_img}") }}" alt="Profile Image"
                                        class="rounded-circle" style="width: 100px; height: 100px;">
                                    <span id="rating" class="badge"
                                        style="position: absolute; top: 0; right: 70;">{{ number_format($averageRating->average_rating, 2) }}</span>
                                    <div class="podium-info rounded p-3 mt-3 shadow">
                                        <span>{{ $averageRating->tutor->tutor_firstname }}
                                            {{ $averageRating->tutor->tutor_lastname }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>




        
               





























    </div>


    <script>
        const imageContainer = document.getElementById('imageContainer');
        const images = document.querySelectorAll('#imageContainer img');

        let currentIndex = 0;

        function changeImage() {
            images.forEach(image => {
                image.style.display = 'none';
            });

            images[currentIndex].style.display = 'block';

            currentIndex++;
            if (currentIndex >= images.length) {
                currentIndex = 0;
            }
        }
        setInterval(changeImage, 3000);
        changeImage();
    </script>

    <script>
        function updateTime() {
            var now = new Date();
            var timeString = [now.getHours(), now.getMinutes(), now.getSeconds()].map(n => n.toString().padStart(2, '0'))
                .join(':');
            document.getElementById('current-time').innerText = timeString;
        }

        setInterval(updateTime, 1000);
        updateTime();
    </script>
@endsection
