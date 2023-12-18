@extends('layouts.adminsidebar')
{{-- @extends('layouts.navbartest') --}}
<style>
    .custom-badge {
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: bold;
    }

    .badge-success.custom-badge {
        background-color: #28a745;
        color: white;
    }

    .badge-danger.custom-badge {
        background-color: #dc3545;
        color: white;

    }
</style>

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{ url('/admin') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('/admin/promotes') }}">Promotes</a></li>
        </ol>
    </nav>
@endsection


@section('title')
    <div class="col-lg-12">
        <h1 class="h2">Promotes</h1>
    </div>
@endsection


@section('content')
    {{-- <main class="py-4">
        @yield('content')
    </main> --}}

    <style>
        div.col-lg-12 {
            color: #000000;
        }

        b {
            font-size: 25px;
        }
    </style>

    <div class='container mt-2'>
        <h1 class="h2"><b>คอร์สเรียน</b></h1>
        <div class='row'>
            @if ($message = Session::get('success'))
                <div class="alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
        </div>
    </div>
    <div class='container mt-2' style="max-height: 500px; overflow-y:auto;">
        <div style="overflow-x:auto;">
            <table class="table table-dark table-hover table-borderless">
                <tr>
                    <th class="table-light">ผู้ขออนุมัติ</th>
                    <th class="table-light">รายการอนุมัติ</th>
                    <th class="table-light">วัน/เดือน/ปี</th>
                    <th class="table-light">สถานะ</th>
                    <th class="table-light">อนุมัติ</th>

                </tr>


                @foreach ($courses as $course)
                    <tr>
                        <td>
                            @if ($course->tutors->isNotEmpty())
                                @foreach ($course->tutors as $tutor)
                                    {{ $tutor->tutor_firstname }} {{ $tutor->tutor_lastname }}
                                @endforeach
                            @else
                                ไม่มีติวเตอร์
                            @endif
                        </td>
                        <td>{{ $course->course_name }}</td>
                        <td>{{ $course->created_at->format('d/m/Y H:i:s') }}</td>
                        <td>
                            @if ($course->course_status == 1)
                                <span class="badge badge-success custom-badge">อนุมัติแล้ว</span>
                            @elseif($course->course_status == 0)
                                <span class="badge badge-danger custom-badge">รอการอนุมัติ</span>
                            @else
                                ไม่ทราบ
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST">
                                <a href="{{ route('admin.courses.edit', $course->id) }}"
                                    class="btn btn-warning">ดูข้อมูล</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">ลบข้อมูล</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
@endsection






{{-- อะไรไม่รู้แต่เก็บไว้ก่อน --}}
{{-- <form action="{{ route('promotes.destroy', $promote->promote_id) }}" method="POST">
    <a href="{{ route('promotes.edit', $promote->promote_id) }}" class="btn btn-warning">รอการอนุมัติ</a>
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">ไม่อนุมัติ</button>
</form> --}}
