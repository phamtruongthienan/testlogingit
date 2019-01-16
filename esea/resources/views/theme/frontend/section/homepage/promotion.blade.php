<div class="section-promotion-copy">
    <div class="container-2 w-container">
        @if(count($promotion) > 0)
            <div class="div-block-1103-copy">
                <h1 class="homepage-title">{{trans('front.homepage.promotions')}}</h1>
            </div>
            <div class="div-block-1288 block-promotion-list">
                @php $class_promotion = 0; @endphp
                @foreach($promotion as $k => $v)
                    @php
                        $logo_promotion =  Imgfly::imgPublic($v->mSchooleventtranslations[0]->logo.'?w=550');
                    @endphp
                    @if($class_promotion == 0)
                        <div class="div-promotion" style="background-image: url({{$logo_promotion}});">
                            <a href="{{asset($v->mSchooleventtranslations[0]->slug)}}"
                               class="link-promotion w-inline-block"></a>
                        </div>
                    @else
                        <div class="div-promotion _{{$class_promotion}}"
                             style="background-image: url({{$logo_promotion}});">
                            <a href="{{asset($v->mSchooleventtranslations[0]->slug)}}"
                               class="link-promotion w-inline-block"></a>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="div-block-1103"><a href="{{ asset('promotion') }}"
                                           class="view-promotion">{{trans('front.homepage.viewall.promotions')}}</a>
            </div>
        @endif
        @if(!empty($config_main))

            <div class="div-block-4">
                <blockquote class="block-quote-2"><strong class="bold-text-17">&quot;</strong>
                    {{$config_main[0]->configMaintranslations[0]->slogan}}
                    <strong class="bold-text-17">&quot;</strong><br></blockquote>
                <div class="text-block-59">{{$config_main[0]->configMaintranslations[0]->quote}}</div>
            </div>
        @endif

    </div>
</div>