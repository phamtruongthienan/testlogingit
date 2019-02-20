<div id="Introdution" class="section-18">
    <div class="main-container w-container">
        {{ Breadcrumbs::render('detailschool', $school_detail[0]) }}
        <div class="div-block-1259">
            @if($school_detail[0]->logo !== null)
                @if(filter_var($school_detail[0]->logo, FILTER_VALIDATE_URL) === FALSE)
                    @php $logo_school = asset('img/'.$school_detail[0]->logo); @endphp
                @else
                    @php $logo_school = $school_detail[0]->logo; @endphp
                @endif
            @else
                @php $logo_school = $noimage; @endphp
            @endif
            <div class="row">
                <div class="col-2"><img src="{{$logo_school}}" alt="Esearch"></div>
                <div class="col-6">
                    <h1 class="heading-22">
                        <strong class="heading-title-2">{{$school_detail[0]->mSchooltranslations[0]->name}}</strong>
                        @for ($rating = 1; $rating <= $school_detail[0]->rating; $rating++)
                            <i class="fas fa-star text-warning" style="font-size:15px"></i>
                        @endfor
                    </h1>
                    <div class="div-block-1151" style="margin-top:10px" id="MapD">
                        <a class="address-link-2" target="_blank" rel="noreferrer" href="https://www.google.com/maps/search/{{ urlencode($school_detail[0]->mSchooltranslations[0]->name.', '.$school_detail[0]->mSchooltranslations[0]->address) }}" class="link-7" style="font-size:13px">
                            <i class="fas fa-map-marked-alt"></i> {{$school_detail[0]->mSchooltranslations[0]->address}} - <span style="text-decoration: underline;font-weight:700">{{trans('front.homepage.intro.seeonthemap')}}</span>
                        </a>
                    </div>
                    <div class="div-block-1151" style="margin-top:10px">
                            <div class="div-icon-text">
                                <div class="div-block-ico"></div>
                                <div class="text-language-2">{{$school_detail[0]->configCity->name}}</div>
                            </div>
                            <div class="div-icon-text">
                                <div class="div-block-ico _1"></div>
                                <div class="text-language-2">{{$school_detail[0]->mSchoollevel->mSchoolleveltranslations[0]->name}}</div>
                            </div>
                            <div class="div-icon-text">
                                <div class="div-block-ico _2"></div>
                                <div class="text-language-2"> @php $array_language = []; @endphp
                                    @foreach($school_detail[0]->mSchoollanguagecourses as $i => $items)
                                        @php
                                            if(!empty($items->mSchoollanguage->mSchoollanguagetranslations[0]->name)) {
                                                array_push($array_language, $items->mSchoollanguage->mSchoollanguagetranslations[0]->name);
                                            }
                                        @endphp
                                    @endforeach
                                    {{implode(', ', $array_language)}}</div>
                            </div>
                        </div>
                </div>
                <div class="col-4" style="text-align: center;margin-top: 20px;">
                        <div style="margin-bottom: 20px;">
                                @php
                                $count = 0;
                                $index = 1;
                                foreach($school_detail[0]->mSchoolcategoryratings as $key => $val) {
                                    $count += $val->rating; 
                                    $index++;
                                }
                                @endphp
                            <span class="badge badge-primary" style="margin-right:10px; margin-bottom: 5px; font-size:15px">{{trans('front.homepage.intro.rating1')}}: {{round($count/$index)}}/10</span>
                            <span class="badge badge-primary" style="margin-right:10px;font-size:15px">{{trans('front.homepage.intro.review')}}: {{$school_detail[0]->review}}</span>
                        </div>
                        <ul class="social-network social-circle">
                                <li>
                                    <a data-toggle="tooltip" data-placement="bottom" data-original-title="Liên hệ" href="tel:{{$school_detail[0]->mSchooltranslations[0]->phone}}" alt="Contact" class="icoRss" rel="noreferrer" target="_blank">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                </li>
                                <li>
                                    <a  data-toggle="tooltip" data-placement="bottom" data-original-title="Fanpage" href="{{$school_detail[0]->facebook_page}}" class="icoFacebook"  alt="Facebook" rel="noreferrer" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                @if(!empty(Auth::user()))
                                    @if(count($school_detail[0]->mWishlists) == 0)
                                        @php 
                                            $action_wl = 1; 
                                            $style_wl = 'background-color: #D3D3D3 !important;';
                                        @endphp  
                                    @else
                                        @php 
                                            $action_wl = 0; 
                                            $style_wl = 'background-color: #BD3518 !important;';
                                        @endphp
                                    @endif
                                <li>
                                <a  style="{{$style_wl}}" data-toggle="tooltip" data-placement="bottom" data-id="{{$school_detail[0]->id}}" data-action="{{$action_wl}}" data-original-title="Thêm vào danh sách yêu thích" href="#" class="icoGoogle wish-list">
                                        <i class="fas fa-heart"></i>
                                    </a>
                                </li>
                                @endif
                        </ul>	
                        
                </div>
            </div>
            <div class="div-block-1258">
                <div class="div-block-66 sub-menu-detail">
                    <a href="#Introdution" class="link-block-17 w-inline-block anchor-animation"
                       style="background-color:{{$school_detail[0]->background_intro}}">
                        <div class="div-block-1263 _3"></div>
                        <div class="text-block-98">{{trans('front.homepage.intro.intodution')}}</div>
                    </a>
                    <a href="#Facilities" class="link-block-17 _1 w-inline-block anchor-animation"
                       style="background-color:{{$school_detail[0]->background_facility}}">
                        <div class="div-block-1263 _4"></div>
                        <div class="text-block-98">{{trans('front.homepage.intro.facilities')}}</div>
                    </a>
                    <a href="#price" class="link-block-17 _2 w-inline-block anchor-animation"
                       style="background-color:{{$school_detail[0]->background_price}}">
                        <div class="div-block-1263"></div>
                        <div class="text-block-98">{{trans('front.homepage.intro.price')}}</div>
                    </a>
                    <a href="#Review" class="link-block-17 _3 w-inline-block anchor-animation review-click"
                       style="background-color:{{$school_detail[0]->background_review}}">
                        <div class="div-block-1263 _1"></div>
                        <div class="text-block-98">{{trans('front.homepage.intro.review')}}</div>
                    </a>
                    <a href="#" class="link-block-17 _4 w-inline-block  open-map-location" data-id="{{$school_detail[0]->id}}"
                       style="background-color:{{$school_detail[0]->background_map}}">
                        <div class="div-block-1263 _2"></div>
                        <div class="text-block-98">{{trans('front.homepage.intro.map')}}</div>
                    </a>
                </div>
                <div class="div-block-1260">
                    <div class="detail-section-introdution-2">
                        <div class="list-div">
                            <h2 class="heading-product-menu">{{trans('front.homepage.intro.intodution')}}</h2>
                            <p class="paragraph-7-hide b-description_readmore">
                                {{$school_detail[0]->mSchooltranslations[0]->description}}
                            </p>
                        </div>
                        <div class="div-block-1-copy" style="align-self: flex-start;margin-top: 105px;">
                            <div data-delay="4000" data-animation="cross" data-autoplay="1" data-duration="500"
                                 data-infinite="1" class="slider-8 w-slider">
                                <div class="w-slider-mask">

                                    @foreach($school_detail[0]->mSchoolimages as $key => $val)
                                        @if($val->is_intro == 1)
                                            <div class="w-slider-mask-item">
                                                <div class="w-slide"
                                                     style="background-image:url({{asset('img/'.$val->image)}});background-size:cover"></div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="w-slider-arrow-left">
                                    <div class="w-icon-slider-left"></div>
                                </div>
                                <div class="w-slider-arrow-right">
                                    <div class="w-icon-slider-right"></div>
                                </div>
                                <div class="slide-nav-4 w-slider-nav w-round"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="div-block-1268">
                    <h2 class="heading-product-menu-1-copy">{{trans('front.homepage.intro.sellingpoint')}} </h2>
                    <div class="div-block-1267-copy">
                        <p class="b-description_readmore">
                            {{$school_detail[0]->mSchooltranslations[0]->content}}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>