{{-- @extends('layouts.navbartest') --}}
@extends('layouts.adminsidebar')
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
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('/admin/news') }}">News</a></li>
        </ol>
    </nav>
@endsection


@section('title')
    <div class="col-lg-12">
        <h1 class="h2">News</h1>
    </div>
@endsection


@section('content')
    <style>
        div.col-lg-12 {
            color: #000000;
        }

        b {
            font-size: 25px;
        }
    </style>



    <div class="container mt-2">
        <h1 class="h2"><b>ข่าวสาร</b></h1>
        <div class="row col-10 col-xl-5 mb-4 mb-lg-0">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif


            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- ////////////////////////////// -->
                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <!-- <strong>รายละเอียดของข่าวสาร</strong> -->
                            <input type="file" name="news_img" class="form-control" placeholder="รูปข่าวสาร">
                            @error('news_img')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <!-- <strong>ชื่อหัวข้อข่าวสาร</strong> -->
                            <input type="text" name="news_title" class="form-control" placeholder="ชื่อหัวข้อข่าวสาร">
                            @error('news_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group my-2">
                            <!-- <strong>รายละเอียดของข่าวสาร</strong> -->
                            <textarea type="text" name="news_detail" class="form-control" placeholder="รายละเอียดของข่าวสาร"></textarea>
                            @error('news_detail')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group my-2">
                            <!-- <strong>รายละเอียดของข่าวสาร</strong> -->
                            <input type="tel" name="news_tel" class="form-control" placeholder="เบอร์โทร">
                            @error('news_tel')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-danger ">เพิ่มข่าวสาร</button>
                    </div>
                </div>
            </form>
        </div>


        <div class='container mt-3'>
            <div>
                @if ($message = Session::get('success'))
                    <div class="alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div>
                    <h5>รายการข่าวสาร</h5>
                    <table class="table table-dark table-hover table-borderless">
                        <thead>
                            <tr>
                                <th class="table-light">รูปข่าวสาร</th>
                                <th class="table-light">หัวข้อข่าวสาร</th>
                                <th class="table-light">สถานะ</th>
                            </tr>
                        </thead>
                        @foreach ($news as $new)
                            <tr>
                                <td><img width="125px" height="100px" src="{{ url("storage/{$new->news_img}") }}" />
                                </td>
                                <td>{{ $new->news_title }}</td>
                                <td>{{ $new->news_detail }}</td>
                                <td>
                                    <form action="{{ route('news.destroy', $new->news_id) }}" method="POST">
                                        <a href="{{ route('news.edit', $new->news_id) }}"
                                            class="btn btn-warning">ดูข้อมูล</a>
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
        </div>
    @endsection
