@extends('theme.layout.frontend.main')
@section('style')
<style>
    .dd-selected-text { 
        font-size:15px !important;
    }
    .dd-select {
        height: 60px !important;
    }
    .select-holder {
        font-size: 15px !important;
    }
    .search-sticky {
        height:60px !important
    }
</style>
@endsection
@section('content')
<div class="main-section">
    <div class="main-container _1 w-container">
        <div class="div-block-2-column">
            @include('theme.frontend.section.schools.sidebar')
            @include('theme.frontend.section.schools.main')
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
<script>
        var searchLanguage = [
            @foreach($school_language as $k => $v)
            {
                text: "{{trans('front.homepage.school.language')}} {{$v->mSchoollanguagetranslations[0]->name}}",
                value: '{{$v->id}}',
                selected: false,
                description: " {{trans('front.homepage.school.languagedes')}} {{$v->mSchoollanguagetranslations[0]->name}}",
            },
            @endforeach
        ];

        var searchSchoolType = [
            @foreach($school_type as $k => $v)
            {
                text: "{{$v->mSchooltypetranslations[0]->name}}",
                value: '{{$v->id}}',
                selected: false,
                description: "{{trans('front.homepage.school.typedes')}} {{$v->mSchooltypetranslations[0]->name}}",
            },
            @endforeach
        ];

        var searchSchoolLevel = [
            @foreach($school_level as $k => $v)
            {
                text: "{{$v->mSchoolleveltranslations[0]->name}}",
                value: '{{$v->id}}',
                selected: false,
                description: "{{trans('front.homepage.school.leveldes')}} {{$v->mSchoolleveltranslations[0]->name}}",
            },
            @endforeach
        ];
    </script>
    <script src="{{asset('assets/frontend/js/school-course.js')}}" type="text/javascript"></script>
@endsection