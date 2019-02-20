@extends('theme.layout.frontend.main')

@section('content')

    <div class="main-section">
        <div class="main-container _1 w-container">
            @if(count($promotion) == 1)
            {{ Breadcrumbs::render('promotiondetail', $promotion[0], 'home.promotion.detail') }}
            @else
            {{ Breadcrumbs::render('promotions') }}
            @endif
            <div class="div-block-2-column unset-background">
                <div class="row w-100">
                    <div class="col-9">
                        @include('theme.frontend.section.promotion.content')
                        <div class="row">
                            <div class="col-12">
                                <div class="div-block-1207  w-100">
                                        {{ $promotion->links() }}
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

@section('script')
    <script>
        var num_promo = {{ $config_main[0]->configMaintranslations[0]->num_promo }};

        @if(count($promotion) == 1)
            var exclude_promo = {{ $promotion[0]->id }};
            var current_page_promotion = 0;
        @else
            var exclude_promo = 0;
            var current_page_promotion = 1;
        @endif
    </script>
    <script src="{{asset('assets/frontend/js/promotion.js')}}" type="text/javascript"></script>
@endsection