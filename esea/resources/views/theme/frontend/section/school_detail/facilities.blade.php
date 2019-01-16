<div id="Facilities" class="section-promotion">
    <div class="container-15 w-container">
        <div class="div-block-1270">
            <div class="div-block-1278">
                <div class="div-block-1179">
                    <h2 class="heading-product-menu">{{trans('front.homepage.intro.facilities')}} </h2>
                    <div class="div-block-1178-copy-2">
                        <div class="div-block-1230">
                            @foreach($school_detail[0]->mSchoolcategoryratings as $key => $val)
                                <div class="text-block-facility-2">{{$val->mSchoolcategory->mSchoolcategorytranslations[0]->name}}
                                    : <strong class="bold-text-27">{{$val->rating}}/10</strong></div>
                                <div class="div-block-1267 _1">
                                    @if($val->rating < 10)
                                        @for($i = 1;$i <= $val->rating; $i++)
                                            <div class="div-block-1245"></div>
                                        @endfor
                                        @php
                                            $grey = 10 - $val->rating;
                                        @endphp
                                        @for($i = 1;$i <= $grey; $i++)
                                            <div class="div-block-1245 grey"></div>
                                        @endfor
                                    @else
                                        @for($i = 1;$i <= 10; $i++)
                                            <div class="div-block-1245"></div>
                                        @endfor
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="div-block-1150">
                    @foreach($school_detail[0]->mSchoolattributeratings as $key => $val)

                        <div class="div-block-1149">
                            <div class="{{$val->mSchoolattribute->icon}}"></div>
                            <div class="text-block-65">{{$val->mSchoolattribute->mSchoolattributetranslations[0]->name}}</div>
                        </div>
                    @endforeach
                </div>
                
                @if(!empty($school_detail[0]->file_pdf))
                <div class="div-block-1269 item-flex-start">
                    @php
                        $link_pdf = asset('view/pdf/'.base64_encode(basename($school_detail[0]->file_pdf,'.pdf')).'.pdf');
                    @endphp
                    <h2 class="heading-product-menu">{{trans('front.homepage.intro.price')}}</h2>
                    @if(!empty(Auth::user()))
                    <a target="_blank" href="{{$link_pdf}}" class="button-11 w-button">View pdf details school fee<br></a>
                    @else
                    <a href="{{asset('login')}}?ref={{request()->path()}}" class="button-11 w-button"> {{trans('front.homepage.intro.logintoview')}}<br></a>
                    @endif
                </div>
                @endif


                @if(!empty(Auth::user()))
                    @if(count($school_detail[0]->mSchoolattributeaddons) > 0)
                        @foreach($school_detail[0]->mSchoolattributeaddons as $key => $val)
                            @foreach($val->mSchoolattributeaddontranslations as $keys => $item)
                                <div class="div-block-1272">
                                    <div class="text-block-product-fee-2">{{$item->name}}</div>
                                    <div class="div-block-1154">
                                        <div class="div-block-1153">
                                        <div data-content="{{$item->content}}" data-keys="{{$keys}}" class="table_render" id="table_render_{{$keys}}"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @endif
                @endif

            </div>
            <div class="div-block-1271">
                <div class="sidebar-wrapper">
                    <h2 class="heading-product-menu-copy">{{trans('front.homepage.intro.opening')}}</h2>
                    <div class="div-block-1221">
                        <div class="div-block-1188-copy">
                            <div class="sidebar-non-wrapper">

                                @foreach($school_detail[0]->mSchoolcourses as $key => $val)
                                    @if(!empty($val->mSchoolprograms[0]))
                                        @if(!empty($val->end_date))
                                            @if($val->end_date >= $now)
                                                <div class="div-block-1189">
                                                    <div class="div-block-1261">
                                                        <div class="icon date"></div>
                                                        <div class="text-block-82">{{\Carbon\Carbon::parse($val->start_date)->format($config_language[0]->date_format)}}</div>
                                                    </div>
                                                    <div class="div-block-1194-copy">
                                                        <div class="icon school"></div>
                                                        <a href="{{asset($val->mSchoolcoursetranslations[0]->slug)}}"
                                                        class="link-23-copy-2 school-score" data-id="{{$val->mSchoolcoursetranslations[0]->id}}">{{$val->mSchoolcoursetranslations[0]->name}}</a>
                                                    </div>
                                                    <div class="div-block-1194-copy">
                                                        <div class="text-block-product-opening">{{$val->mSchoolcoursetranslations[0]->name_class}}
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                        @endif
                                    @else
                                        <div class="div-block-1189">
                                            <div class="div-block-1261">
                                                <div class="icon date"></div>
                                                <div class="text-block-82">{{\Carbon\Carbon::parse($val->start_date)->format($config_language[0]->date_format)}}</div>
                                            </div>
                                            <div class="div-block-1194-copy">
                                                <div class="icon school"></div>
                                                <a href="#"
                                                   class="link-23-copy-2">{{$val->mSchoolcoursetranslations[0]->name}}</a>
                                            </div>
                                            <div class="div-block-1194-copy">
                                                <div class="icon time"></div>
                                                <div class="text-block-product-opening">{{$val->mSchoolcoursetranslations[0]->name_class}}
                                            </div>
                                        </div>
                                    @endif
                                    @endif
                                @endforeach

                            </div>
                        </div>
                        <div class="w-embed">
                            <style>
                                .sidebar-wrapper {
                                    position: -webkit-sticky;
                                    position: -moz-sticky;
                                    position: -ms-sticky;
                                    position: -o-sticky;
                                    position: sticky;
                                    top: 50px;
                                }
                            </style>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="Price" class="container-16 w-container"></div>
</div>