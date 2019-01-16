@extends('theme.layout.frontend.main')

@section('content')
    <div class="main-section">
        <div class="main-container _1 w-container">
            {{ Breadcrumbs::render('course_detail', $detail[0]->mSchoolcourse->mSchool->mSchooltranslations[0]->name , $detail[0]->mSchoolcourse->mSchool->mSchooltranslations[0]->slug , $detail[0]->name,$detail[0]->slug) }}
            <div class="div-block-2-column unset-background">
                <div class="row w-100">
                    <div class="col-9">
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-12">
                            <div class="div-block-2-column-2-copy-copy w-100 h-100 text-justify"
                                style="unset:margin;background-color:#fff; padding:10px;margin-top:-1px;margin: 0px;">
                                <div class="div-block-1205">
                                    <div class="div-block-1283">
                                        <div class="div-block-1282">
                                            <h1 class="heading-title-2">
                                                <strong class="bold-text-28">
                                                <a href="{{asset($detail[0]->slug)}}"> {{$detail[0]->name}} </a>
                                                </strong>
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                                    {!! $detail[0]->content !!}     
                                    <div class="list-unstyled block-collapse">
                                        @foreach($program as $key => $val)
                                            <a href="#collapseExample{{$val->id}}" data-toggle="collapse"
                                            class="list-group-item list-group-item-action flex-column align-items-start">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1"><i class="fas fa-caret-right"></i> {{$val->mSchoolProgramTranslations[0]->name}}</h5>
                                                    <small class="text-muted">
                                                        <div class="div-block-1194-copy">
                                                            <div class="icon time"></div>
                                                            <div class="text-block-product-opening">{{$val->time}}
                                                                {{trans('front.school.detail.unit'.$val->unit_1)}}
                                                                / {{trans('front.school.detail.unit'.$val->unit_2)}}
                                                            </div>
                                                        </div>
                                                        <div class="div-block-1194-copy">
                                                            <div class="icon money"></div>
                                                            <div class="text-block-product-opening">{{number_format($val->fee/$rate)}} {{ $config_language[0]->currency_code }}
                                                                / {{$val->unit_4}} {{trans('front.school.detail.unit'.$val->unit_3)}}</div>
                                                        </div>
                                                    </small>
                                                </div>
                                            </a>
                                            <div class="collapse" id="collapseExample{{$val->id}}">
                                                <div class="block-collapse-item">
                                                    {!! $val->mSchoolProgramTranslations[0]->content !!}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        @include('theme.frontend.section.promotion.ads')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-email-enter">
        <div class="container w-container">
            @include('theme.frontend.section.homepage.subscribe')
        </div>
    </div>
@endsection