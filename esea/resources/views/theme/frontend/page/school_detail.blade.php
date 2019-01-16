@extends('theme.layout.frontend.main')
@section('style')
@endsection
@section('content')
    @include('theme.frontend.section.school_detail.slider')
    @include('theme.frontend.section.school_detail.intro')
    @include('theme.frontend.section.school_detail.gallery')
    @include('theme.frontend.section.school_detail.facilities')
    @if(!empty(Auth::user()))
        @include('theme.frontend.section.school_detail.compare')
        @include('theme.frontend.section.school_detail.review')
    @endif
    <div class="section-email-enter">
        <div class="container w-container">
            @include('theme.frontend.section.homepage.subscribe')
        </div>
    </div>
    <div data-w-id="bb662fc0-80e3-7dc4-7a71-0f3ee4513483" class="section-12 sub-menu-detail-fix" style="">
        <div class="container-7 w-container">
            <div class="div-block-72-copy">
                <div class="div-block-95-copy">
                    <a href="#Introdution" class="link-35 w-button anchor-animation">{{trans('front.homepage.intro.intodution')}}</a>
                    <a href="#Facilities" class="link-35 w-button anchor-animation">{{trans('front.homepage.intro.facilities')}}</a>
                    <a href="#Price" class="link-35 w-button anchor-animation">{{trans('front.homepage.intro.price')}}</a>
                    @if(!empty(Auth::user()))
                    <a href="#Review" class="link-35 w-button anchor-animation">{{trans('front.homepage.intro.review')}}</a>
                    @endif
                    <a style="color: #f04e23;" data-id="{{$school_detail[0]->id}}" class="link-35 w-button open-map-location">{{trans('front.homepage.intro.map')}}</a>
                </div>
                <a href="#" class="link-5 w-button" data-toggle="modal" data-target="#booking">{{trans('front.homepage.intro.booking')}}</a></div>
        </div>
    </div>
@endsection

@section('script')
<script>
        var school_id = '{{$school_detail[0]->id}}';
        var count_all = '{{count($school_detail[0]->mSchoolcomments)}}';
        var count_page = Math.ceil(count_all/5);
        $('#review_pagination').twbsPagination({
            totalPages: count_page,
            next: '›',
            prev: '‹',
            visiblePages: 5,
            hideOnlyOnePage: true,
            onPageClick: function (event, page) {
                skeleton('#review_pagination');
                $('.page-review').hide();
                $('#page-review-'+page).show();
                $('.review-click').trigger('click');
                $('.b-description_readmore').moreLines({
                        linecount: 5,
                        baseclass: 'b-description', 
                        basejsclass: 'js-description',
                        classspecific: '_readmore',
                        buttontxtmore: "<div class='b-description_readmore_button2'><i class='fas fa-chevron-circle-down'></i> Xem thêm</div>", 
                        buttontxtless: "<div class='b-description_readmore_button2'><i class='fas fa-chevron-circle-up'></i> Thu gọn</div>",
                        animationspeed: 250
                        
                    });
            }
        });
    </script>
    <script src="{{asset('assets/frontend/js/booking.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/frontend/js/detail.js')}}" type="text/javascript"></script>
@endsection