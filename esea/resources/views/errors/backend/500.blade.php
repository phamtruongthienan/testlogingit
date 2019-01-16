
@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/employee.min.css')}}">
@endsection

@section('content')
    <div class="error-page">
        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Something went wrong.</h3>
            <p>
                We will work on fixing that right away.
                Meanwhile, you may <a href="{{ asset('/') }}">return to dashboard</a>.
            </p>
        </div>
    </div>
@endsection
