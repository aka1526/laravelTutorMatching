@extends('layouts.adminsidebar')
{{-- @extends('layouts.sidebar') --}}

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
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item active"><a href="{{ url('/admin') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('/admin/InfoTutor') }}">Tutors</a></li>
        </ol>
    </nav>
@endsection


@section('content')
    <style>
        div.col-lg-12 {
            color: #000000;
        }

        b {
            font-size: 25px;
        }

        .alert-success {
            color: #04f600
        }

        .custom-badge {
            font-size: 0.8rem;
            padding: 0.2rem 0.5rem;
        }

        .table-responsive {
            overflow-x: auto;
        }
    </style>



    <!-- ////////////////// -->
    <div class="container mt-2">
        <h1 class="h2"><b>ติวเตอร์</b></h1>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <h5 class="mt-2">รายการติวเตอร์</h5>

        <div class="table-responsive">
            <table class="table table-dark table-hover table-borderless">
                <thead>
                    <tr>
                        <th class="table-light">ID</th>
                        <th class="table-light">ชื่อ-นามสกุล</th>
                        <th class="table-light">สถานที่</th>
                        <th class="table-light">ประสบการ์ณ</th>
                        <th class="table-light">สถานะ</th>
                        <th class="table-light">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tutors as $tutor)
                        <tr>
                            <td>{{ $tutor->id }}</td>
                            <td>{{ $tutor->tutor_firstname }} {{ $tutor->tutor_lastname }}</td>
                            <td>{{ $tutor->infotutor->info_tutor_location }}</td>
                            <td>{{ $tutor->infotutor->info_tutor_exp }} ปี</td>
                            <td>
                                @if ($tutor->is_tutor === 1)
                                    <span class="badge badge-success custom-badge">อนุมัติแล้ว</span>
                                @else
                                    <span class="badge badge-danger custom-badge">รอการอนุมัติ</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('tutors.destroy', $tutor->id) }}" method="POST">
                                    <a href="{{ route('tutors.edit', $tutor->id) }}" class="btn btn-warning">ดูข้อมูล</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">ลบข้อมูล</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
