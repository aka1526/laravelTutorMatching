<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TUTOR-MATCHING</title>
    {{-- <title>{{ config('app.name', 'TUTORMATCHING') }}</title> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Chewy' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        #topicLegend {
            font-family: "Kanit", sans-serif;
            font-size: 50px;
        }

        #boxtopic {
            font-family: "Chewy";
            font-size: 50px;
        }
    </style>
</head>

<body id="">

    <form action="{{ route('userform.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="main" id="section1">
            <section class="page-section d-flex justify-content-center align-items-center" id="topic">
                <div class="container">
                    <legend class="checkbox-group-legend" id="topicLegend"><b>Welcome to Tutor Matching</b></legend>
                    <a href="#section2"><i class='bx bxs-chevrons-down bx-fade-down'></i></a>
                </div>
            </section>
        </div>


        <div class="main" id="section2">
            <section class="page-section d-flex justify-content-center align-items-center" id="targetSection">
                <div class="container">
                    <legend class="checkbox-group-legend">วิชาที่คุณสนใจ?</legend>
                    <div class="grid-container">
                        <div class="box">
                            <div class="item">
                                <div class="checkbox-rect2">
                                    <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                                    <input class="form-check-input" type="checkbox" id="checkbox-rect1" value="1"
                                        name="subject_id[]">
                                    <label for="checkbox-rect1">คณิตศาสตร์</label>
                                </div>
                            </div>
                            <div class="item">
                                <div class="checkbox-rect2">
                                    <input class="form-check-input" type="checkbox" id="checkbox-rect2"value="2"
                                        name="subject_id[]">
                                    <label for="checkbox-rect2">ฟิสิกส์</label>
                                </div>
                            </div>
                            <div class="item">
                                <div class="checkbox-rect2">
                                    <input class="form-check-input" type="checkbox" id="checkbox-rect3" value="6"
                                        name="subject_id[]">
                                    <label for="checkbox-rect3">เคมี</label>
                                </div>
                            </div>
                            <div class="item">
                                <div class="checkbox-rect2">
                                    <input class="form-check-input" type="checkbox" id="checkbox-rect4" value="7"
                                        name="subject_id[]">
                                    <label for="checkbox-rect4">ชีววิทยา</label>
                                </div>
                            </div>
                            <div class="item">
                                <div class="checkbox-rect2">
                                    <input class="form-check-input" type="checkbox" id="checkbox-rect5" value="5"
                                        name="subject_id[]">
                                    <label for="checkbox-rect5">สังคมศึกษา</label>
                                </div>
                            </div>
                            <div class="item">
                                <div class="checkbox-rect2">
                                    <input class="form-check-input" type="checkbox" id="checkbox-rect6" value="3"
                                        name="subject_id[]">
                                    <label for="checkbox-rect6">ภาษาไทย</label>
                                </div>
                            </div>
                            <div class="item">
                                <div class="checkbox-rect2">
                                    <input class="form-check-input" type="checkbox" id="checkbox-rect7" value="4"
                                        name="subject_id[]">
                                    <label for="checkbox-rect7">ภาษาอังกฤษ</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#section3"><i class='bx bxs-chevrons-down bx-fade-down'></i></a>
                </div>
            </section>
        </div>



        <!-- Section 2: Locations -->
        <div class="main" id="section3">
            <section class="page-section d-flex justify-content-center align-items-center" id="location">
                <div class="container">
                    <legend class="checkbox-group-legend ">คุณอยู่จังหวัดอะไร?</legend>
                    <div class="custom-select">
                        <select class="form-control" name="province">
                            <option class="text-center" value="">--เลือกจังหวัด--</option>
                            <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
                            <option value="กระบี่">กระบี่</option>
                            <option value="กาญจนบุรี">กาญจนบุรี</option>
                            <option value="กาฬสินธุ์">กาฬสินธุ์</option>
                            <option value="กำแพงเพชร">กำแพงเพชร</option>
                            <option value="ขอนแก่น">ขอนแก่น</option>
                            <option value="จันทบุรี">จันทบุรี</option>
                            <option value="ฉะเชิงเทรา">ฉะเชิงเทรา</option>
                            <option value="ชลบุรี">ชลบุรี</option>
                            <option value="ชัยนาท">ชัยนาท</option>
                            <option value="ชัยภูมิ">ชัยภูมิ</option>
                            <option value="ชุมพร">ชุมพร</option>
                            <option value="เชียงราย">เชียงราย</option>
                            <option value="เชียงใหม่">เชียงใหม่</option>
                            <option value="ตรัง">ตรัง</option>
                            <option value="ตราด">ตราด</option>
                            <option value="ตาก">ตาก</option>
                            <option value="นครนายก">นครนายก</option>
                            <option value="นครปฐม">นครปฐม</option>
                            <option value="นครพนม">นครพนม</option>
                            <option value="นครราชสีมา">นครราชสีมา</option>
                            <option value="นครศรีธรรมราช">นครศรีธรรมราช</option>
                            <option value="นครสวรรค์">นครสวรรค์</option>
                            <option value="นนทบุรี">นนทบุรี</option>
                            <option value="นราธิวาส">นราธิวาส</option>
                            <option value="น่าน">น่าน</option>
                            <option value="บึงกาฬ">บึงกาฬ</option>
                            <option value="บุรีรัมย์">บุรีรัมย์</option>
                            <option value="ปทุมธานี">ปทุมธานี</option>
                            <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์</option>
                            <option value="ปราจีนบุรี">ปราจีนบุรี</option>
                            <option value="ปัตตานี">ปัตตานี</option>
                            <option value="พะเยา">พะเยา</option>
                            <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา</option>
                            <option value="พังงา">พังงา</option>
                            <option value="พัทลุง">พัทลุง</option>
                            <option value="พิจิตร">พิจิตร</option>
                            <option value="พิษณุโลก">พิษณุโลก</option>
                            <option value="เพชรบุรี">เพชรบุรี</option>
                            <option value="เพชรบูรณ์">เพชรบูรณ์</option>
                            <option value="แพร่">แพร่</option>
                            <option value="ภูเก็ต">ภูเก็ต</option>
                            <option value="มหาสารคาม">มหาสารคาม</option>
                            <option value="มุกดาหาร">มุกดาหาร</option>
                            <option value="แม่ฮ่องสอน">แม่ฮ่องสอน</option>
                            <option value="ยโสธร">ยโสธร</option>
                            <option value="ยะลา">ยะลา</option>
                            <option value="ร้อยเอ็ด">ร้อยเอ็ด</option>
                            <option value="ระนอง">ระนอง</option>
                            <option value="ระยอง">ระยอง</option>
                            <option value="ราชบุรี">ราชบุรี</option>
                            <option value="ลพบุรี">ลพบุรี</option>
                            <option value="ลำปาง">ลำปาง</option>
                            <option value="ลำพูน">ลำพูน</option>
                            <option value="เลย">เลย</option>
                            <option value="ศรีสะเกษ">ศรีสะเกษ</option>
                            <option value="สกลนคร">สกลนคร</option>
                            <option value="สงขลา">สงขลา</option>
                            <option value="สตูล">สตูล</option>
                            <option value="สมุทรปราการ">สมุทรปราการ</option>
                            <option value="สมุทรสงคราม">สมุทรสงคราม</option>
                            <option value="สมุทรสาคร">สมุทรสาคร</option>
                            <option value="สมุทรสาคร">สมุทรสาคร</option>
                            <option value="สระแก้ว">สระแก้ว</option>
                            <option value="สระบุรี">สระบุรี</option>
                            <option value="สิงห์บุรี">สิงห์บุรี</option>
                            <option value="	สุโขทัย">สุโขทัย</option>
                            <option value="สุพรรณบุรี">สุพรรณบุรี</option>
                            <option value="สุราษฎร์ธานี">สุราษฎร์ธานี</option>
                            <option value="สุรินทร์">สุรินทร์</option>
                            <option value="หนองคาย">หนองคาย</option>
                            <option value="หนองบัวลำภู">หนองบัวลำภู</option>
                            <option value="อ่างทอง">อ่างทอง</option>
                            <option value="อำนาจเจริญ">อำนาจเจริญ</option>
                            <option value="อุดรธานี">อุดรธานี</option>
                            <option value="อุตรดิตถ์">อุตรดิตถ์</option>
                            <option value="อุทัยธานี">อุทัยธานี</option>
                            <option value="อุบลราชธานี">อุบลราชธานี</option>
                        </select>
                    </div>
                    <a href="#section4"><i class='bx bxs-chevrons-down bx-fade-down'></i></a>
                </div>
            </section>
        </div>



        <!-- Section 3: Education Levels -->
        <div class="main" id="section4">
            <section class="page-section " id="Edlevel">
                <div class="container">
                    <legend class="checkbox-group-legend">ระดับการศึกษาของคุณ?</legend>
                    <div class="grid-container">
                        <div class="box">
                            <div class="item">
                                <div class="checkbox-rect2">
                                    <input class="form-check-input" type="checkbox" id="checkbox-mo1"
                                        value="มัธยมศึกษาปีที่ 1" name="level[]">
                                    <label for="checkbox-mo1">มัธยมศึกษาปีที่ 1</label>
                                </div>
                            </div>
                            <div class="item">
                                <div class="checkbox-rect2">
                                    <input class="form-check-input" type="checkbox" id="checkbox-mo2"
                                        value="มัธยมศึกษาปีที่ 2" name="level[]">
                                    <label for="checkbox-mo2">มัธยมศึกษาปีที่ 2</label>
                                </div>
                            </div>
                            <div class="item">
                                <div class="checkbox-rect2">
                                    <input class="form-check-input" type="checkbox" id="checkbox-mo3"
                                        value="มัธยมศึกษาปีที่ 3" name="level[]">
                                    <label for="checkbox-mo3">มัธยมศึกษาปีที่ 3</label>
                                </div>
                            </div>
                            <div class="item">
                                <div class="checkbox-rect2">
                                    <input class="form-check-input" type="checkbox" id="checkbox-mo4"
                                        value="มัธยมศึกษาปีที่ 4" name="level[]">
                                    <label for="checkbox-mo4">มัธยมศึกษาปีที่ 4</label>
                                </div>
                            </div>
                            <div class="item">
                                <div class="checkbox-rect2">
                                    <input class="form-check-input" type="checkbox" id="checkbox-mo5"
                                        value="มัธยมศึกษาปีที่ 5" name="level[]">
                                    <label for="checkbox-mo5">มัธยมศึกษาปีที่ 5</label>
                                </div>
                            </div>
                            <div class="item">
                                <div class="checkbox-rect2">
                                    <input class="form-check-input" type="checkbox" id="checkbox-mo6"
                                        value="มัธยมศึกษาปีที่ 6" name="level[]">
                                    <label for="checkbox-mo6">มัธยมศึกษาปีที่ 6</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#section5"><i class='bx bxs-chevrons-down bx-fade-down'></i></a>
                </div>
            </section>
        </div>


        <div class="main" id="section5">
            <section class="page-section" id="style">
                <div class="container">
                    <legend class="checkbox-group-legend">คุณต้องการรูปแบบในการสอนแบบไหน?</legend>
                    <div class="grid-container">
                        <div class="box">
                            <div class="item">
                                <div class="checkbox-rect2">
                                    <input class="form-check-input" type="checkbox" id="checkbox-mm1"
                                        value="การสอนแบบตัวต่อตัว" name="stlye[]">
                                    <label for="checkbox-mm1">เรียนแบบตัวต่อตัว</label>
                                </div>
                            </div>
                            <div class="item">
                                <div class="checkbox-rect2">
                                    <input class="form-check-input" type="checkbox" id="checkbox-mm2"
                                        value="การสอนแบบกลุ่ม" name="stlye[]">
                                    <label for="checkbox-mm2">เรียนแบบเป็นกลุ่ม</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#section6"><i class='bx bxs-chevrons-down bx-fade-down'></i></a>
                </div>
            </section>
        </div>


        <div class="main" id="section6">
            <section class="page-section" id="team">
                <div class="container">
                    <legend class="checkbox-group-legend">คุณต้องการอาจารย์ผู้ชายหรือผู้หญิง?</legend>
                    <div class="grid-container">
                        <div class="box">
                            <div class="item">
                                <div class="checkbox-rect2">
                                    <input class="form-check-input" type="checkbox" id="checkbox-te1" value="ผู้ชาย"
                                        name="gender[]">
                                    <label for="checkbox-te1">อาจารย์ผู้ชาย</label>
                                </div>
                            </div>
                            <div class="item">
                                <div class="checkbox-rect2">
                                    <input class="form-check-input" type="checkbox" id="checkbox-te2"
                                        value="ผู้หญิง" name="gender[]">
                                    <label for="checkbox-te2">อาจารย์ผู้หญิง</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger">ยืนยัน</button>
                </div>
            </section>
        </div>


    </form>



    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        $(document).ready(function() {
            $("a").on('click', function(event) {
                if (this.hash !== "") {
                    event.preventDefault();
                    var hash = this.hash;
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 50, function() {
                        window.location.hash = hash;
                    });
                }
            });
        });
    </script>
</body>

</html>
