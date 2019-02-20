@extends('theme.layout.frontend.main')

@section('content')
    <div class="section-16">
        <div class="w-container">
            <div class="utility-page-wrap">
                <div class="utility-page-content-copy">
                    <div class="div-block-1219"></div>
                    <h2>Page not found</h2>
                    <div class="text-block-88">The page you are looking for doesn&#x27;t exist or has been moved.</div>
                    <a href="{{asset('/')}}" class="button-2 w-button">Return to Homepage</a></div>
            </div>
        </div>
    </div>
    <div class="section-email-enter">
        <div class="container w-container">
            @include('theme.frontend.section.homepage.subscribe')
        </div>
    </div>
@endsection

@section('script')

@endsection