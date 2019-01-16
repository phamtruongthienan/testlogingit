<div class="div-block-2-column-2-copy">
    <div class="div-block-72-23-copy block-search-advanced-top">
      <div class="div-block-1121">
      <a href="{{ $sorts_query_high }}" class="div-block-1281 w-inline-block">
          <div class="icon low"></div>
          <div>{{trans('front.homepage.search.pricelowtohigh')}}</div>
        </a>
        <a href="{{ $sorts_query_low}}" class="div-block-1281 w-inline-block">
          <div class="icon high"></div>
          <div>{{trans('front.homepage.search.pricehightolow')}}</div>
        </a>
        <a class="div-block-1281 w-inline-block open-map">
          <div class="icon near"></div>
          <div>{{trans('front.homepage.search.near')}}</div>
        </a>
      </div>
    </div>

    @if(count($schools) == 0)
        <blockquote class="block-quote-2" style="color:#ccc">Không tìm thấy kết quả nào phù hợp.</blockquote>
    @endif

    @if(count($ads) > 0) 
    @foreach($ads as $ka => $va)
        @if($va->link == null)
        @break;
        @endif
        @if($va->position == 1 && $va->type==3)
            @if(filter_var($va->link, FILTER_VALIDATE_URL) === FALSE)
                @php $ads_link = asset($va->link); @endphp
            @else
                @php $ads_link = $va->link; @endphp
            @endif

            @if(!empty($va->mAdvertstranslations[0]->image))
                @php $ads_image = Imgfly::imgPublic($va->mAdvertstranslations[0]->image.'?w=850'); @endphp
            @else
                @php $ads_image = $noimage; @endphp
            @endif
            <div class="advertising" style=" background-image: url({{$ads_image}});">
                <a href="{{ $ads_link }}" target="_blank" class="link-block-promotion w-inline-block w--current"></a>
            </div>
            @break;
        @endif
    @endforeach
  @endif

    @php 
      $inads = true;
    @endphp
    @if(count($schools) > 0)
      @foreach($schools as $k => $v)
      @if($k > 0)
        @if(((count($schools)%$k)))
          @if($inads)

            @if(count($ads) > 0) 
              @foreach($ads as $ka => $va)
              @if($va->link == null)
              @break;
              @endif
                  @if($va->position == 4 && $va->type==3)
                      @if(filter_var($va->link, FILTER_VALIDATE_URL) === FALSE)
                          @php $ads_link = asset($va->link); @endphp
                      @else
                          @php $ads_link = $va->link; @endphp
                      @endif
          
                      @if(!empty($va->mAdvertstranslations[0]->image))
                          @php $ads_image = Imgfly::imgPublic($va->mAdvertstranslations[0]->image.'?w=850'); @endphp
                      @else
                          @php $ads_image = $noimage; @endphp
                      @endif
                      <div class="advertising" style=" background-image: url({{$ads_image}});">
                          <a href="{{ $ads_link }}" target="_blank" class="link-block-promotion w-inline-block w--current"></a>
                      </div>
                      @break;
                  @endif
              @endforeach
            @endif

            @php 
              $inads = false;
            @endphp
          @endif
        @endif
      @endif

        <div class="product">
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
            
          <div class="product-photo _1" style="background-image: url({{$image_avatar}});height:250px"></div>
          <div class="div-block-1176">
            <div class="div-block-71">
              <div class="div-block-1119">
                <h3 class="h2-school-name"><a href="{{asset($v->mSchooltranslations[0]->slug)}}">{{$v->mSchooltranslations[0]->name}}</a></h3>
                <div class="div-block-diamond">
                    @for ($rating = 1; $rating <= $v->rating; $rating++)
                    <i class="fas fa-star text-warning"></i>
                    @endfor
                </div>
              </div>
              <div class="div-block-1105-copy">
                <div class="div-icon-text">
                  <div class="div-block-ico"></div>
                  <div class="text-language-copy">{{$v->configCity->name}}</div>
                </div>
                <div class="div-icon-text">
                  <div class="div-block-ico _1"></div>
                  <div class="text-language-copy">{{ $v->mSchoollevel->mSchoolleveltranslations[0]->name }}</div>
                </div>
                <div class="div-icon-text">
                  <div class="div-block-ico _2"></div>
                  <div class="text-language-copy">
                      @php $array_language = []; @endphp
                      @foreach($v->mSchoollanguagecourses as $i => $items)
                          @php
                              if(!empty($items->mSchoollanguage->mSchoollanguagetranslations[0]->name)) {
                                  array_push($array_language, $items->mSchoollanguage->mSchoollanguagetranslations[0]->name);
                              }
                          @endphp
                      @endforeach
                      {{implode(', ', $array_language)}}

                  </div>
                </div>
              </div>
            </div>
            <div class="div-block-69 w-clearfix"><a href="#" class="link-block-4 w-inline-block"></a>
              <a target="_blank" href="https://www.google.com/maps/search/{{ urlencode($v->mSchooltranslations[0]->name.' '.$v->mSchooltranslations[0]->address) }}" class="link-7" style="font-size:13px">{{$v->mSchooltranslations[0]->address}}</a></div>
            <p class="paragraph-6">
              @if(mb_strlen($v->mSchooltranslations[0]->description) > 150)
                {{ mb_substr($v->mSchooltranslations[0]->description, 0, 150)}}...
              @else
                {{ $v->mSchooltranslations[0]->description}}
              @endif
            </p>
            <div class="div-block-70">
                @foreach($v->mSchoolattributeratings as $key => $val)
                  @if($key < 8)
                    <div data-toggle="tooltip" data-placement="top" title="{{$val->mSchoolattribute->mSchoolattributetranslations[0]->name}}" style="width:25px;height:25px;margin-left:10px" class="{{$val->mSchoolattribute->icon}}"></div>
                  @endif
              @endforeach
            </div>
          </div>
          <div class="div-block-1177">
            <div class="list-div" style="width:60%">
                <div class="div-block-1228">
                
                <div class="div-bloock-1178-copy-2 hover-school" id="show-rating-{{$v->id}}">
                    <div id="w-node-59f22195f889-6e55e55e">
                        @php
                            $count = 0;
                            $index = 1;
                        @endphp
                        @foreach($v->mSchoolcategoryratings as $key => $val)
                        <div class="text-block-facility-2">{{$val->mSchoolcategory->mSchoolcategorytranslations[0]->name}}: <strong class="bold">{{$val->rating}}/10</strong></div>
                        <div class="div-block-1267">
                            @php $count += $val->rating; $index++;@endphp
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
                  <div data-w-id="f4314a5f-d739-f26c-7632-67ea6fe28e91" class="text-block-94 hover-rating" data-id="{{$v->id}}">{{round($count/$index)}}/10</div>
                </div>
                
                <div class="text-block-32"><b class="text-danger">{{$v->review}} </b><span class="margin-left-5">{{trans('front.homepage.school.reviews')}}</span><br></div>
              </div>
              
            <a href="{{asset($v->mSchooltranslations[0]->slug)}}" class="button-8 w-button">{{trans('front.homepage.school.viewmore')}}</a></div>
        </div>
      @endforeach
    @endif
 

    @if(count($ads) > 0) 
    @foreach($ads as $ka => $va)
        @if($va->link == null)
        @break;
        @endif
        @if($va->position == 2 && $va->type==3)
            @if(filter_var($va->link, FILTER_VALIDATE_URL) === FALSE)
                @php $ads_link = asset($va->link); @endphp
            @else
                @php $ads_link = $va->link; @endphp
            @endif

            @if(!empty($va->mAdvertstranslations[0]->image))
                @php $ads_image = Imgfly::imgPublic($va->mAdvertstranslations[0]->image.'?w=850'); @endphp
            @else
                @php $ads_image = $noimage; @endphp
            @endif
            <div class="advertising" style=" background-image: url({{$ads_image}});">
                <a href="{{ $ads_link }}" target="_blank" class="link-block-promotion w-inline-block w--current"></a>
            </div>
            @break;
        @endif
    @endforeach
  @endif

    {{ $schools->links() }}

  </div>