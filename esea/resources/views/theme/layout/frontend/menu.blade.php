<nav role="navigation" class="nav-menu-2 w-nav-menu">
    <div class="div-block-2">
        <div class="div-block-5"></div>
        <a href="{{asset('/schools')}}" class="nav-menu w-nav-link">{{trans('front.homepage.schoolandcourse')}}</a>
        <a href="{{asset('/promotion')}}" class="nav-menu w-nav-link">{{trans('front.homepage.promotions')}}</a>
        @if(!empty($menu))
            @foreach($menu as $k => $v)

                @if($v->position == 1)
                    <a href="@if(empty($v->news_id)){{asset($v->mMenuTranslations[0]->slug)}}@else{{asset($v->mNews->mNewsTranslations[0]->slug)}}@endif"
                       class="nav-menu w-nav-link">{{$v->mMenuTranslations[0]->name}}</a>
                @endif
            @endforeach
        @endif
    </div>

    <div class="div-block">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            @if(LaravelLocalization::getCurrentLocale() != $properties['regional'])
                <a class="lead margin-right-10" id="switch-language" rel="alternate" hreflang="{{ $localeCode }}"
                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    <span style="font-size:20px" class="flag-icon flag-icon-{{ $properties['regional'] }}"></span>
                </a>
            @endif
        @endforeach
        <div class="div-block-5-short"></div>
        @if(empty(Auth::user()))
            <a href="{{asset('/login')}}"
               class="nav-menu w-nav-link">{{mb_strtoupper(trans('front.homepage.signin.login'))}}</a>
            <a href="{{asset('/sign-up')}}"
               class="nav-menu-login w-nav-link">{{mb_strtoupper(trans('front.homepage.createaccount'))}}</a>
        @else
            <div data-delay="0" class="w-dropdown">
                <div class="dropdown-toggle-3 w-dropdown-toggle">
                    @if(Auth::user()->logo !== null)
                        @if(filter_var(Auth::user()->logo, FILTER_VALIDATE_URL) === FALSE)
                            @php $logo_avatar = asset('img/'.Auth::user()->logo); @endphp
                        @else
                            @php $logo_avatar = Auth::user()->logo; @endphp
                        @endif
                    @else
                        @php $logo_avatar = $noimage; @endphp
                    @endif
                    <div class="div-block-102" style="background-image: url({{ $logo_avatar }});"></div>
                    <div class="w-icon-dropdown-toggle"></div>
                    <div class="text-block-44">{{Auth::user()->name}}</div>
                </div>
                <nav class="dropdown-list-2 w-dropdown-list">
                    <a href="{{asset('/account')}}" class="dropdown-link-2 w-dropdown-link">Account</a>
                    <a href="{{asset('logout')}}" class="dropdown-link-2 w-dropdown-link">Log out</a>
                </nav>
            </div>
        @endif
    </div>
    <div class="div-block-72-23-copy-copy">
        <div class="div-block-1121">
            <a href="#" class="div-block-1281 w-inline-block">
                <div class="icon low"></div>
                <div>Price low to high</div>
            </a>
            <a href="#" class="div-block-1281 w-inline-block">
                <div class="icon high"></div>
                <div>Price high to low</div>
            </a>
            <a href="#" class="div-block-1281 w-inline-block">
                <div class="icon near"></div>
                <div>Near me</div>
            </a>
        </div>
        <div class="div-block-74"><a href="#" data-w-id="8d4f4dc9-53e4-97fc-4148-7cebf3adfe86"
                                     class="button-6-copy-copy w-button">Advanced search</a></div>
    </div>
</nav>