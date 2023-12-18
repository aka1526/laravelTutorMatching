@extends('layouts.navbartest')

@section('content')
    <main class="py-4">
        @yield('content')
    </main>

    <div class='container mt-1'>
        <div class='row'>
            <div class="col-lg-12">
                <h2><b>Tutor</b></h2>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
