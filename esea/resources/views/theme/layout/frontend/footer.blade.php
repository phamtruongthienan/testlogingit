<div class="section-footer-copy">
    <div class="container w-container">
        <div class="row-2 w-row">
            <div class="col-foot w-col w-col-3 w-col-small-6 w-col-tiny-tiny-stack">
                <a href="{{ asset('booking') }}" class="link _1">{{trans('front.homepage.intro.booking')}}</a>
                <a href="{{ asset('schools') }}" class="link _1">{{trans('front.homepage.schoolandcourse')}}</a>

            </div>
            <div class="col-foot w-col w-col-3 w-col-small-6 w-col-tiny-tiny-stack">
                <a href="{{ asset('promotion') }}" class="link _2">{{trans('front.homepage.promotions')}}</a>
                <a href="{{ asset('sitemap') }}" class="link _1">{{trans('front.homepage.sitemap')}}</a>
            </div>
            <div class="col-foot w-col w-col-3 w-col-small-6 w-col-tiny-tiny-stack">
                @if(!empty($menu))
                    @foreach($menu as $k => $v)
                        @if($v->position == 3)
                            <a  class="link _2" href="@if(empty($v->news_id)){{asset($v->mMenuTranslations[0]->slug)}}@else{{asset($v->mNews->mNewsTranslations[0]->slug)}}@endif">{{$v->mMenuTranslations[0]->name}}</a>
                        @endif
                    @endforeach
                @endif
            </div>

            <div class="col-foot w-col w-col-3 w-col-small-6 w-col-tiny-tiny-stack">
                <div class="div-block-89">
                    <div class="div-block-90">
                        <div class="link-bold-copy">Hotline</div>
                        <a href="tel:+84905473368" class="link-14">{{ $config_main[0]->configMaintranslations[0]->phone}}</a></div>
                    <div class="div-block-62">
                        <a href="{{ $config_main[0]->configMaintranslations[0]->facebook_page }}" class="link-block-6 w-inline-block">
                            <img src="{{ asset('/assets/frontend/images/fb.png') }}">
                        </a>
                        <a href="{{ $config_main[0]->configMaintranslations[0]->googleplus_page }}" class="link-block-6 w-inline-block">
                                <img src="{{ asset('/assets/frontend/images/gg.png') }}">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copy-right div-block-20">
        <div class="text-block">{{ $config_main[0]->configMaintranslations[0]->company_name }}. All Rights Reserved.</div>
    </div>
</div>
<div class="top-sub-menu">
    <a href="#" class="top w-inline-block" id="back-to-top">
        <div class="div-block-75"></div>
    </a>
</div>
