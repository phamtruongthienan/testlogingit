@section('news')
    @if(isset($details))
        <div class="row" style="margin-bottom:10px;">
            <div class="col-12">
                <div class="div-block-2-column-2-copy-copy w-100 h-100"
                    style="unset:margin;background-color:#fff; padding:10px;margin-top:-1px;margin: 0px;">
                    <div class="div-block-1205">
                        <div class="">
                            <div class="div-block-1282">
                                <h1 class="heading-title-2">
                                    <strong class="bold-text-28">
                                    <a href='{{ asset($list_news[0]->slug) }}'> {{ $list_news[0]->title}} </a>
                                    </strong>
                                </h1>
                            </div>
                        </div>
                    </div>                      
                        {!! $list_news[0]->content !!}                
                    </div>
                </div>
            </div>
    @else
        @foreach($list_news as $k => $items)
            <div class="row" style="margin-bottom:10px;">
                <div class="col-12">
                    <div class="div-block-2-column-2-copy-copy w-100 h-100"
                        style="unset:margin;background-color:#fff; padding:10px;margin-top:-1px;margin: 0px;">
                        <div class="div-block-1205">
                            <div class="">
                                <div class="div-block-1282">
                                    <h1 class="heading-title-2">
                                        <strong class="bold-text-28">
                                        <a href="{{ asset($items->mNewstranslations[0]->slug) }}"> {{ $items->mNewstranslations[0]->title }} </a>
                                        </strong>
                                    </h1>
                                </div>
                            </div>
                        </div>
                            @if(count($list_news[0]->mNewstranslations) == 1)
                                <div class="w-richtext">
                            @else
                                <div class="w-richtext b-description_readmore text-justify">
                            @endif
                                {!! $items->mNewstranslations[0]->content !!}
                            </div>
                        </div>

                    </div>
                </div>
        @endforeach
    @endif
@endsection
