<div class="school-section">
    <div class="love-container _1 w-container">
        <div class="div-block-1103">
            <h1 class="homepage-title orange">{{trans('front.homepage.topschoolcourse')}}</h1>
        </div>
        <div class="div-block-1158">
            @if(count($school) > 0)
                @foreach($school as $k => $v)

                <a href="{{asset($v->mSchooltranslations[0]->slug)}}" title="{{$v->mSchooltranslations[0]->name}}"
                       alt="{{$v->mSchooltranslations[0]->name}}" class="div-product w-inline-block">
                        @php
                            $image_avatar = $noimage;
                        @endphp
                        @foreach($v->mSchoolimages as $i => $image)
                            @if($image->is_avatar == 1)
                                @php
                                    $image_avatar =  Imgfly::imgPublic($image->image.'?w=300');
                                @endphp
                            @endif
                        @endforeach

                        @if($v->logo !== null)
                            @if(filter_var($v->logo, FILTER_VALIDATE_URL) === FALSE)
                                @php $logo_school = asset('img/'.$v->logo); @endphp
                            @else
                                @php $logo_school = $v->logo; @endphp
                            @endif
                        @else
                            @php $logo_school = ''; @endphp
                        @endif

                        <div class="div-photo-school" style="background-image: url({{$image_avatar}});">

                        </div>
                        @if($logo_school != '')
                        <div class="logo-background">
                            <div class="logo-background-inside" style="background-image: url({{$logo_school}});"></div>
                        </div>
                        @php
                            $count = 0;
                            $index = 1;
                        @endphp
                        @foreach($v->mSchoolcategoryratings as $key => $val)
                         @php $count += $val->rating; $index++;@endphp
                        @endforeach
                        <div class="logo-background-2" style="float:left">
                                Rating: {{round($count/$index)}}/10
                        </div>
                        <div class="logo-background-2" style="float:right">
                                Review: {{$v->review}}
                        </div>
                        @endif
                        <div class="div-block-1102" style="top: -25px;">
                            <div class="div-block-1106">
                                <h3 class="h2-school-name pink">{{$v->mSchooltranslations[0]->name}}</h3>
                                <div class="div-block-diamond">
                                  
                                    @for ($rating = 1; $rating <= $v->rating; $rating++)
                                    <i class="fas fa-star text-warning"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="div-block-1105">
                                <div class="div-icon-text">
                                    <div class="div-block-ico"></div>
                                    <div class="text-language">{{$v->configCity->name}}</div>
                                </div>
                                <div class="div-icon-text">
                                    <div class="div-block-ico _1"></div>
                                    <div class="text-language">{{$v->mSchoollevel->mSchoolleveltranslations[0]->name}}</div>
                                </div>
                                <div class="div-icon-text">
                                    <div class="div-block-ico _2"></div>
                                    <div class="text-language">
                                        @php $array_language = []; @endphp
                                        @foreach($v->mSchoollanguagecourses as $i => $items)
                                            @php
                                                if(!empty($items->mSchoollanguage->mSchoollanguagetranslations[0]->name)) {
                                                    array_push($array_language, $items->mSchoollanguage->mSchoollanguagetranslations[0]->name);
                                                }
                                            @endphp
                                        @endforeach
                                        {{implode(', ', $array_language)}}
                                        <br>‍
                                    </div>
                                </div>
                                <div class="div-icon-text" style="margin-right:10px">
                                    @foreach($v->mSchoolattributeratings as $key => $val)
                                        @if($key < 6)
                                            <div data-toggle="tooltip" data-placement="top" title="{{$val->mSchoolattribute->mSchoolattributetranslations[0]->name}}" style="width:25px;height:25px;margin-left:10px" class="{{$val->mSchoolattribute->icon}}"></div>
                                        @else
                                            <div style="font-size: 10px;width:15px;height:15px;margin-left:10px;color:#f60867" class="fas fa-plus"></div>
                                            @break
                                        @endif
                                  @endforeach
                                </div>
                            </div>
                            
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
        <div class="div-block-1103"><a href="{{ asset('schools') }}"
                                       class="view-promotion-copy">{{trans('front.homepage.viewall.school')}}</a></div>
    </div>
</div>