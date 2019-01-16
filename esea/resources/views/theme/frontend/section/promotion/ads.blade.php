
@if(count($ads) > 0) 
    @foreach($ads as $k => $v)
        @if($v->link == null)
        @break;
        @endif
        @if($v->position == 3 && $v->type==3)
            @if(filter_var($v->link, FILTER_VALIDATE_URL) === FALSE)
                @php $ads_link = asset($v->link); @endphp
            @else
                @php $ads_link = $v->link; @endphp
            @endif

            @if(!empty($v->mAdvertstranslations[0]->image))
                @php $ads_image = Imgfly::imgPublic($v->mAdvertstranslations[0]->image.'?w=300'); @endphp
            @else
                @php $ads_image = $noimage; @endphp
            @endif

            <div class="div-block-57" style=" background-image: url({{$ads_image}});">
                <a href="{{ $ads_link }}" target="_blank" class="link-block-promotion w-inline-block w--current"></a>
            </div>
        @endif
    @endforeach
@endif

