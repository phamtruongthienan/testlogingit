@extends('theme.layout.frontend.main')
@section('meta')
    <meta name="{{$view->meta_title}}" content="{{$view->meta_title}}">
    <meta name="{{$view->meta_keyword}}" content="{{$view->meta_keyword}}">
    <meta name="{{$view->meta_description}}" content="{{$view->meta_description}}">
@endsection
@section('content')

    @php
        $path = $view->mNews->mLayout->path;
    @endphp
    @include($path)
    <div class="section-email-enter">
        <div class="container w-container">
            @include('theme.frontend.section.homepage.subscribe')
        </div>
    </div>
@endsection

@section('script')
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        @if(LaravelLocalization::getCurrentLocale() != $properties['regional'])
            @php
                $slug_change = asset($properties['regional'].'/'.$view_slug->slug);
            @endphp
            <script>
                $(function () {
                    $('#switch-language').attr('href', '{{$slug_change}}');
                });
            </script>
        @endif
    @endforeach

@endsection