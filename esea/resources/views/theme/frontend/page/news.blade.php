@extends('theme.layout.frontend.main')

@section('content')
    <div class="main-section">
        <div class="main-container _1 w-container">
            <div class="div-block-2-column unset-background">
                <div class="row w-100">
                    <div class="col-9">
                        <!-- @include('theme.frontend.section.news.content') -->
                        @yield('news')
                        <div class="load-more-result"></div>
                        <div class="row">
                            <div class="col-12">
                                <div class="div-block-1207  w-100">
                                    <a href="#" class="link-5-copy w-button ladda-button" id="view-more-promotion"
                                        data-style="expand-right" data-size="l"><span
                                                class="ladda-label">+ View more</span></a>
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
@endsection

@section('script')

@endsection