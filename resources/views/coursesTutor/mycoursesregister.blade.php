<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TUTOR-MATCHING</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/mycourses.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutors/feedback.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        #containerCard {
            background-color: whitesmoke;
        }

        #navlink1 a:hover {
            color: #ff3232;
        }

        .nav-link.btn.btn-danger {
            border-radius: 20px;
            color: whitesmoke;
            font-weight: bold;
            margin-bottom: 9px;
        }

        .button-container {
    display: flex;
    justify-content: space-around; /* Adjust as needed */
    align-items: center;
}

    </style>
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

    <div class="sidebar">
        <ul class="sidebar-nav">
            <li><a href="{{ route('tutor.mycourse',auth()->guard('tutor')->user()->id) }}">คอร์สของฉัน</a></li>
            <li><a href="{{ route('tutor.mycourse.register',auth()->guard('tutor')->user()->id) }}">รายชื่อผู้ซื้อคอร์ส</a></li>
            <li><a href="{{ route('feedback', ['id' => auth()->guard('tutor')->user()->id]) }}">รีวิวผลตอบรับ</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>เอกสารลงทะเบียนทั้งหมด</h1>
        <div class="row">
            <div class="col-xl-3 col-md-3">
                <div class="card bg-danger text-white mb-4 text-center">
                    <div class="card-body" style="padding: 1rem;">
                        <h3>รวมรายได้ทั้งหมด</h3>
                        <h2 style="font-size: 1.5rem;">{{ number_format($CoursTotal->where('approve_status','=','Y')->sum('course_price'),0) }} บาท</h2>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3">
                <div class="card bg-danger text-white mb-4 text-center">
                    <div class="card-body" style="padding: 1rem;">
                        <h3>ลงทะเบียนทั้งหมด</h3>
                        <h2 style="font-size: 1.5rem;">{{ $CoursTotal->count() }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3">
                <div class="card bg-danger text-white mb-4 text-center">
                    <div class="card-body" style="padding: 1rem;">
                        <h3>เอกสารรออนุมัติ</h3>
                        <h2 style="font-size: 1.5rem;">{{ $CoursTotal->where('approve_status','=','W')->count() }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3">
                <div class="card bg-danger text-white mb-4 text-center">
                    <div class="card-body" style="padding: 1rem;">
                        <h3>เอกสารอนุมัติแล้ว</h3>
                        <h2 style="font-size: 1.5rem;">{{ $CoursTotal->where('approve_status','!=','W')->count() }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" id="containerCard" style="max-height: 500px; overflow-y: auto;">
            <div class="row">
                <table class="table">
                    <thead>
                      <tr class=" bg-danger text-white">
                        <th scope="col" >#</th>
                        <th scope="col">เลขที่สมัคร</th>
                        <th scope="col">วันที่สมัคร</th>
                        <th scope="col">ชื่อผู้สมัคร</th>
                        <th scope="col">ชื่อคอร์ส</th>
                        <th scope="col">ราคา</th>
                        <th scope="col">วันที่ต้องการเรียน</th>

                        <th scope="col">เอกสารการโอน</th>
                        <th scope="col" style="width: 180px;">สถานะอนุมัติ</th>

                      </tr>
                    </thead>
                    <tbody>
                @foreach ($CourseRegister as $key=>$item)

                      <tr>
                        <th scope="row">{{ $CourseRegister->firstItem()+$key }}</th>
                        <td>{{ $item->doc_no   }}</td>
                        <td>{{ $item->register_date  }}</td>
                        <td>{{ $item->user_name  }}</td>
                        <td>{{ $item->course_name  }}</td>
                        <td>{{ number_format($item->course_price ,0) }}</td>
                        <td>{{ $item->date_start  }}</td>
                        <td><img src="{{$item->payment_img  }}" class="viewing " style="cursor: pointer;" width="80px"></td>
                        <td>
                            <div class="btn-group" style="width: 100%">

                                    @if($item->approve_status=="W")
                                        <button type="button" class="btn btn-warning ">
                                        รออนุมัติ
                                        </button>
                                        <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split  btn-block" data-bs-toggle="dropdown" aria-expanded="false">
                                    @elseif($item->approve_status=="Y")
                                    <button type="button" class="btn btn-success">
                                        อนุมัติเรียบร้อย
                                    </button>
                                    <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                        @elseif($item->approve_status=="EXP")
                                        <button type="button" class="btn btn-secondary">
                                            หมดเวลา
                                        </button>
                                        @else
                                    <button type="button" class="btn btn-danger">
                                        คืนเงิน
                                    </button>
                                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    @endif


                                  <span class="visually-hidden">สถานะอนุมัติเอกสาร</span>
                                </button>
                                <ul class="dropdown-menu">
                                    @if($item->approve_status=="W")




                                    <li><a class="dropdown-item approve-status" data-doc_no="{{ $item->doc_no }}" data-doc_status="Y" href="javascript:void(0)">อนุมัติ</a></li>
                                    <li><a class="dropdown-item approve-status" data-doc_no="{{ $item->doc_no }}" data-doc_status="N" href="javascript:void(0)">คืนเงิน</a></li>


                                    @elseif($item->approve_status=="Y")
                                    <li><a class="dropdown-item approve-status" data-doc_no="{{ $item->doc_no }}" data-doc_status="N" href="javascript:void(0)">คืนเงิน</a></li>
                                    <li><a class="dropdown-item approve-status" data-doc_no="{{ $item->doc_no }}" data-doc_status="W" href="javascript:void(0)">ล้างใหม่</a></li>
                                    @else
                                    <li><a class="dropdown-item approve-status" data-doc_no="{{ $item->doc_no }}" data-doc_status="W" href="javascript:void(0)">ล้างใหม่</a></li>
                                    @endif

                                </ul>
                              </div>



                        </td>
                      </tr>



                @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="mt-3">
            {{ $CourseRegister->links() }}
        </div>
            </div>
        </div>

    </div>
    </div>


</body>
<script>

$(document).on("click", '.approve-status', function(e) {
	e.preventDefault();
	var doc_no =$(this).data('doc_no');
    var doc_status =$(this).data('doc_status');
    var url ="{{ route('reg.approve.docno') }}";

    Swal.fire({
				title: "คุณต้องการดำเนินการต่อใช่?",

				icon: "warning",
				showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
			}).then((result) => {
				if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data:{doc_no:doc_no,doc_status:doc_status,"_token": "{{ csrf_token() }}"},
                        success: function(data){
                             console.log(data);
                            Swal.fire({
                                title: data.msg,
                                icon:  data.icon,
                                text: data.result,
                                timer: 1500,
                            }).then(() => {

                                 //  location.reload();

                                });
                        }
                    });
				}
			});
});

$(document).on("click", '.viewing', function(e) {
        e.preventDefault();
        var formUrl=this.src;
        openPopup(formUrl);

    });

    function openPopup(formUrl) {
        var screenWidth = window.screen.width;
    var screenHeight = window.screen.height;
    var popupWidth = 600;
    var popupHeight = 400;
    var left = (screenWidth - popupWidth) / 2;
    var top = (screenHeight - popupHeight) / 2;
    var popupWindow = window.open(formUrl, 'Popup', 'width=' + popupWidth + ',height=' + popupHeight + ',left=' + left + ',top=' + top);
    if (popupWindow) {
        popupWindow.focus();
    }
    }
</script>

<script src="{{ asset('js/app.js') }}" defer></script>

</html>
