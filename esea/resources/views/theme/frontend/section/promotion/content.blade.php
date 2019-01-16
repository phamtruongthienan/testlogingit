@foreach($promotion as $k => $items)
    <div class="row" style="margin-bottom:10px;">
        <div class="col-12">
            <div class="div-block-2-column-2-copy-copy w-100 h-100"
                 style="unset:margin;background-color:#fff; padding:10px;margin-top:-1px;margin: 0px;">
                <div class="div-block-1205">
                    <div class="div-block-1283">
                        <div class="div-block-1282">
                            @if($items->start_date > \Carbon\Carbon::now())
                                <div class="icon promotion-big"></div>
                            @endif
                            <h1 class="heading-title-2"><strong class="bold-text-28">
                               <a href="{{ asset($items->mSchooleventtranslations[0]->slug) }}"> {{ $items->mSchooleventtranslations[0]->name}} </a>
                            </strong>
                        </h1>
                        </div>
                        <div class="text-block-87"><i
                                    class="fas fa-calendar-alt"></i> {{\Carbon\Carbon::parse($items->start_date)->format($config_language[0]->date_format)}}
                            - {{\Carbon\Carbon::parse($items->end_date)->format($config_language[0]->date_format)}}
                        </div>


                    </div>
                    {{-- <div class="div-block-1206"><a href="#" class="link-5-copy w-button">Book with this promotion</a></div> --}}
                </div>
                <div class="div-block-1203"></div>
                <div class="text-block-91">Promotion code:</div>
                <div class="div-block-1285">
                    <div id="codePromotion-{{$items->id}}" class="text-block-90">{{mb_strtoupper($items->code)}}</div>
                    <div id="btnCopy" class="text-block-100" style="font-size: 20px;"><i
                                class="fas fa-copy copy-clipboard"
                                data-clipboard-target="#codePromotion-{{$items->id}}"></i></div>
                </div>
                @if(count($promotion) == 1)
                    <div class="w-richtext">
                @else
                    <div class="w-richtext b-description_readmore text-justify">
                @endif
                    {!! $items->mSchooleventtranslations[0]->content !!}
                    @if($items->type == 2)
                        @php $array_school = []; @endphp
                        <div class="list-unstyled">
                            @foreach($items->school as $i => $items)
                                @php
                                    $name = $items->mSchoolTranslations[0]->name;
                                    $slug = asset($items->mSchoolTranslations[0]->slug);
                                @endphp
                                <a href="{{$slug}}"
                                   class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1"><i class="fas fa-caret-right"></i> {{$name}}</h5>
                                        <small class="text-muted"><i style="font-size:8px"
                                                                     class="fas fa-quote-left"></i> {{$items->mSchoolTranslations[0]->slogan}}
                                            <i style="font-size:8px" class="fas fa-quote-right"></i></small>
                                    </div>

                                </a>
                            @endforeach
                        </div>
                    @endif
                    <br>
                </div>

            </div>
        </div>
    </div>
@endforeach

