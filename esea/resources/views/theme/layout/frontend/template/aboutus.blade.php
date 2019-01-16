<div class="section">
    <div class="main-container-left w-container">
        <div class="title">
            <h1 class="hero-heading dark-bg">E-search</h1>
            <p class="hero-subtitle">Là nơi để tìm kiếm thông tin chi tiết chính xác và rõ ràng về mỗi cấp bậc giáo dục
                (Mầm Non, Tiểu Học cho tới Cao Học và các khoá học ngôn ngữ). Sự nhận xét đánh giá khách quan của người
                sử dụng  là một trong tiêu chí hàng đầu để quyết định tính xác thực cho Esearch.</p>
        </div>
    </div>
</div>
<div class="main-section white">
    <div class="main-container w-container">
        <div class="div-block-breadcumb"><a href="{{asset('/')}}" class="link-breadcumb-2">Home</a>
            <div class="div-block-24"></div>
            <a href="{{asset('/'.$view->slug)}}" class="link-breadcumb-now-2">{{$view->title}}</a></div>
        <div class="div-block-2-column">
            <div class="div-block-2-column-3">
                <div class="w-richtext text-justify">
                        {{$view->content}}
                </div>
            </div>
            <div class="div-block-2-column-4">
                <div class="sidebar-wrapper">
                    <div class="div-block-1221">
                        <div class="sidebar-image"></div>
                        @foreach($menu as $key => $val)
                            @if($val->position == 2)
                            <a href="{{asset('/'.$val->mMenutranslations[0]->slug)}}"
                               class="link-24">{{$val->mMenutranslations[0]->name}}</a>
                            @endif
                        @endforeach
                        <div class="w-embed">
                            <style>
                                .sidebar-wrapper {
                                    position: -webkit-sticky;
                                    position: -moz-sticky;
                                    position: -ms-sticky;
                                    position: -o-sticky;
                                    position: sticky;
                                    top: 50px;
                                }
                            </style>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>