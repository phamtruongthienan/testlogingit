<div class="section-21">
    <div class="container-16 w-container">
        <div class="div-block-1140">
            <h2 class="heading-product-menu"> {{trans('front.homepage.intro.rating')}} <em class="italic-text-7"></em></h2>
            <div class="rating-panel">
                    <div class="row div-block-1273">
                        <div class="col-12">
                            @if(count($category) > 0)
                            <div class="div-block-1179">
                                <div class="text-block-64"  style="font-size:20px">{{trans('front.homepage.intro.facilities')}}</div>
                                    <div class="div-block-1178-copy-2 row"  style="display:block;width:100%">
                                    @foreach($category as $k => $v)
                                        <div id="rating-panel-{{$v->id}}">
                                            <div class="text-block-facility-2" id="rating-name-{{$v->id}}">{{$v->mSchoolCategoryTranslations[0]->name}}</div>
                                            <div class="div-block-1287">
                                                <select class="ratingBar" id="ratingBar_{{$v->id}}" name="fac[]" required>
                                                    <option value=""></option>
                                                    @for($i=1; $i <=10; $i++)
                                                <option value="{{$i}}" data-category-id="{{$v->id}}" data-school-id="{{$school_detail[0]->id}}" data-data-tt="{{$i}} điểm">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>        
            </div>

            <div class="rating-panel">
                    <form id="form-review" role="form" data-toggle="validator" novalidate="true">
                        <div class="row div-block-1273">
                            <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 col-12 form-group">
                                <div class="text-block-64 rating-star" style="font-size:20px;text-align: center;">How do you feel a bout this school?</div>
                                <div class="div-block-50 rating-star">
                                    <div class="div-block-12-copy">
                                        @if($reviewed !== false)
                                            @php $current_rating = $reviewed->rating; @endphp
                                        @else 
                                            @php $current_rating = ''; @endphp
                                        @endif
                                    <select class="ratingStar" name="rating" data-current-rating="{{$current_rating}}">
                                            <option value=""></option>
                                            @foreach($config_rating as $k => $v)
                                                <option value="{{$v->rating}}" data-tt="{{$v->mRatingTranslations[0]->name}}" data-html="{{$v->mRatingTranslations[0]->name}}">{{$v->rating}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="div-block-50 rating-score">
                                    <div class="div-block-12-copy">
                                            <div class="current-rating">
                                                <div class="value badge badge-primary"></div>
                                            </div>
                                            <div class="your-rating hidden">
                                                <div class="value badge badge-primary"></div>
                                            </div>
                                    </div>
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 col-12">
                                    <div class="widget-area no-padding blank">
                                        <div class="text-block-64 rating-star" style="font-size:20px;text-align: center;">Please enter your review</div>
                                        <div class="status-upload form-group">
                                                <textarea name="comment" placeholder="Leave your review..." style=" resize: none;" required></textarea>
                                               
                                                <div>
                                                <div style="margin-top: 10px;float: left;">{!! Recaptcha::render() !!}</div>

                                                <a class="w-inline-block btn-review" style="margin-top:2px;float:right">
                                                    <div class="button-review-1">Review</div> 
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                            </div>
                        </div>        
                    </form>
                </div>
            @if($school_detail[0]->review > 0)
            <div class="rating-panel row div-block-1273" id="Review">
                    <div class="div-block-1291" id="review_pagination" style="width: 100%;">
                            <div class="text-block-64 rating-star" style="font-size:20px;text-align: center;">{{$school_detail[0]->review}} reviews from other customer</div>
                        <ul id="comments-list" class="comments-list">
                            @php $page = 1; @endphp
                            @foreach($school_detail[0]->mSchoolcomments->reverse() as $key => $val)
                            @if($val->status == 1)
                                @if($key%5 == 0)
                                    @if($page > 1)
                                        </div>
                                    @endif
                                    @if($page > 1)
                                        <div class="page-review" id="page-review-{{$page}}" style="display:none">
                                    @else
                                    <div class="page-review" id="page-review-{{$page}}">
                                    @endif
                                @endif

                                @if($val->mCustomer->logo !== null)
                                    @if(filter_var($val->mCustomer->logo, FILTER_VALIDATE_URL) === FALSE)
                                        @php $logo_avatar = asset('img/'.$val->mCustomer->logo); @endphp
                                    @else
                                        @php $logo_avatar = $val->mCustomer->logo; @endphp
                                    @endif
                                @else
                                    @php $logo_avatar = $noimage; @endphp
                                @endif
                                
                               
                                        <li>
                                            <div class="comment-main-level">
                                                <div class="comment-avatar"><img src="{{$logo_avatar}}" alt=""></div>
                                                <div class="comment-box">
                                                    <div class="comment-head">
                                                        <div  style="float:left;">
                                                            <h6>{{$val->mCustomer->name}}</h6>
                                                            <small>Thành viên từ năm {{ \Carbon\Carbon::parse($val->mCustomer->created_at)->format('Y')}}</small>
                                                        </div>
                                                        <div  style="float:right;">
                                                            <small>Đã nhận xét vào lúc {{ \Carbon\Carbon::parse($val->created_at)->format($config_language[0]->date_format)}}</small>
                                                            <p style="text-align: right;">
                                                            @for( $i=1; $i <= $val->rating; $i++)
                                                                <span  style="float: right;"><i class="fas fa-star text-warning"></i> </span>
                                                            @endfor
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="comment-content">
                                                       <p class="b-description_readmore">{{$val->content}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(!empty($val->mSchoolCommentReplies[0]))
                                            <ul class="comments-list reply-list">
                                                <li>
                                                  
                                                    <div class="comment-box-2">
                                                        <div class="comment-head">
                                                            <h6 class="comment-name">{{$school_detail[0]->mSchooltranslations[0]->name}}</h6>
                                                            <div  style="float:right;margin-top: 10px;">
                                                                    <small>Đã phản hồi vào lúc {{ \Carbon\Carbon::parse($val->mSchoolCommentReplies[0]->created_at)->format($config_language[0]->date_format)}}</small>
                                                                </div>
                                                        </div>
                                                        <div class="comment-content-2">
                                                                <p class="b-description_readmore">{!!$val->mSchoolCommentReplies[0]->content!!}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @endif
                                        </li>
                                   
                                    @if($key%5 == 0)
                                        @php $page++; @endphp
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                        </div>
                    </div>
                    
            </div>
            @endif
        </div>
    </div>
</div>