<div class="product_photo">
    <div class="w-container">
        <h2 class="heading-product-menu">{{trans('front.homepage.intro.gallery')}}</h2>
        <div class="gallery-content">
            <div class="gallery-slider">
                    @if(!empty($school_detail[0]->file_360))
                    <div class="gallery-item">
                        <a rel="gallery" class="view-normal image-360"  href="{{ asset('img/'.$school_detail[0]->file_360) }}" data-fancybox="images">
                            <div class="div-block-1276"  draggable="false" style="background-image:url({{ asset('img/'.$school_detail[0]->file_360) }});"></div>
                        </a>
                    </div>
                    @endif
                    @if(!empty($school_detail[0]->file_video))
                    @if(preg_match('![?&]{1}v=([^&]+)!', $school_detail[0]->file_video . '&', $video))
                        <div class="gallery-item">
                            <a rel="gallery" class="view-normal image-360"  href="{{ $school_detail[0]->file_video }}" data-fancybox="images">
                                <div class="div-block-1276"  draggable="false" style="background-image:url(https://img.youtube.com/vi/{{ $video[1] }}/maxresdefault.jpg);"></div>
                            </a>
                        </div>
                    @endif
                    @endif
                @if(count($school_detail[0]->mSchoolimages) > 0)
                @foreach($school_detail[0]->mSchoolimages as $key => $val)
                    @if($val->is_gallery == 1)
                        <div class="gallery-item">
                            <a rel="gallery" class="view-normal" href="{{asset('img/'.$val->image)}}" data-fancybox="images">
                                <div class="div-block-1276"  draggable="false" style="background-image:url({{asset('img/'.$val->image)}});"></div>
                            </a>
                        </div>
                    @endif
                @endforeach
                @endif

            </div>
            <div class="icon-long gallery-next"></div>
            <div class="icon-long _1 gallery-prev"></div>
        </div>
    </div>
</div>