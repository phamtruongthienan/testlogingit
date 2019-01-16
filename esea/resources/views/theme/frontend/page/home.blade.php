@extends('theme.layout.frontend.main')
@section('content')
    @include('theme.frontend.section.homepage.search')
    @include('theme.frontend.section.homepage.school')
    @include('theme.frontend.section.homepage.promotion')
    <div class="section-email-enter">
        <div class="container w-container">
            @include('theme.frontend.section.homepage.client')
            @include('theme.frontend.section.homepage.subscribe')
        </div>
    </div>
    <div data-w-id="bc089f57-87f3-ceec-1e56-1ac4a399c880" class="section-8 block-search-basic-fix">
        <div class="container-4 w-container block-search">
            <div class="div-block-1095 block-search-basic row">
                <div class="block-search-txt col-md-9 col-sm-12 row">
                    <div class="col-md-6 col-sm-6">
                        <input placeholder="{{trans('front.homepage.search.keyword')}}"
                                id="txt-search-keyword"
                               class="div-block-109 txt-search txt-search-keyword"/>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <input placeholder="{{trans('front.homepage.search.location')}}"
                                id="txt-search-area"
                               class="div-block-109 txt-search txt-search-area"/>
                    </div>
                </div>
                <div class="div-block-1108-copy col-md-3 col-sm-12">
                    <div class="div-block-109 search">
                            <button id="searchBtn" class="w-inline-block" style="width: 100%;background-color: unset;">
                                    <div class="text-block-48-copy">{{mb_strtoupper(trans('front.homepage.search.button'))}}</div>
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('theme.frontend.section.homepage.search_location')
@endsection

@section('script')
    <script>
        var searchLanguage = [
            @foreach($school_language as $k => $v)
            {
                text: "{{trans('front.homepage.school.language')}} {{$v->mSchoollanguagetranslations[0]->name}}",
                value: '{{$v->id}}',
                selected: false,
                description: "{{trans('front.homepage.school.languagedes')}} {{$v->mSchoollanguagetranslations[0]->name}}",
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
    <script src="{{asset('assets/frontend/js/home.js')}}" type="text/javascript"></script>
@endsection