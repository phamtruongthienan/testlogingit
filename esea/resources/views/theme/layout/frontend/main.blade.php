<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <link href="{{asset('assets/frontend/css/normalize.css')}}?v=1.0.0" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css?v=1.0.0">
    <link rel="stylesheet" href="{{asset('assets/frontend/libs/jquery-ui/jquery-ui.css')}}?v=1.0.0">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/libs/slick/slick.css')}}?v=1.0.0"/>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css?v=1.0.0'>
    <link href="{{asset('assets/frontend/libs/lobibox-master/dist/css/lobibox.min.css')}}?v=1.0.0" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/frontend/libs/flag-icon/css/flag-icon.min.css')}}?v=1.0.0" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/frontend/libs/typeahead/jquery.typeahead.min.css')}}?v=1.0.0" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/frontend/libs/button-loading/button-loading.min.css')}}?v=1.0.0" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/frontend/libs/ibutton/all.min.css')}}?v=1.0.0" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/frontend/libs/skeleton/skeleton.min.css')}}?v=1.0.0" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/frontend/libs/jquery-bar-rating/themes/bars-movie.css')}}?v=1.0.0">
    <link rel="stylesheet" href="{{asset('assets/frontend/libs/jquery-bar-rating/themes/fontawesome-stars.css')}}?v=1.0.0">
    <link rel="stylesheet" href="{{asset('assets/frontend/libs/fancybox/ryxren.css')}}?v=1.0.0">
    <link rel="stylesheet" href="{{asset('assets/frontend/libs/pagination/pagination.min.css')}}?v=1.0.0">
    <link rel="stylesheet" href="{{asset('assets/frontend/libs/sweet-select/jquery.sweet-dropdown.min.css')}}?v=1.0.0">
    <link rel="stylesheet" href="{{asset('assets/frontend/libs/fastselect/fastselect.min.css')}}?v=1.0.0">
    <link rel="stylesheet" href="{{asset('assets/frontend/libs/bootstrap-tagsinput/bootstrap-tagsinput.css')}}?v=1.0.0">
    <link rel="stylesheet" href="{{asset('assets/frontend/libs/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}?v=1.0.0">
    <link href="{{asset('assets/frontend/css/webflow.css')}}?v=1.0.0" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/frontend/css/e-search.webflow.css')}}?v=1.0.0" rel="stylesheet" type="text/css">
    @yield('style')
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js?v=1.0.0" type="text/javascript"></script>
    <!-- [if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js?v=1.0.0"
            type="text/javascript"></script><![endif] -->
    <script type="text/javascript">!function (o, c) {
            var n = c.documentElement, t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
        }(window, document);</script>
    <link href="{{asset('assets/frontend/images/favicon.png')}}?v=1.0.0" rel="shortcut icon" type="image/x-icon">
    <link href="{{asset('assets/frontend/images/webclip.png')}}?v=1.0.0" rel="apple-touch-icon">
    <style>.w-container {
            max-width: 1170px;
        }</style>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/iamceege/tooltipster/master/dist/css/tooltipster.bundle.min.css?v=1.0.0"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/iamceege/tooltipster/master/src/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-borderless.css?v=1.0.0"> -->
    <style>
        .sticky-aside {
            position: -webkit-sticky;
            position: sticky;
        }
        #booking .modal-body {
            padding-left: 2rem;
            padding-right: 2rem;
        }
    </style>
</head>
<body class="body">
@include('theme.layout.frontend.header')
@yield('content')
@include('theme.layout.frontend.footer')
@include('theme.frontend.page.map')
@if(count($ads) > 0) 
@foreach($ads as $ka => $va)
    @if($va->link == null)
    @break;
    @endif
    @if($va->position == 1 && $va->type==2)
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
        <div class="popup_this" style="display:none">
            <a href="{{ $ads_link }}" target="_blank"><img src="{{$ads_image}}" width="500px"></a>
        </div>
        @break;
    @endif
@endforeach
@endif
<script src="{{asset('js/jquery-3.3.1.min.js')}}?v=1.0.0" type="text/javascript"></script>
<script src="{{asset('js/lang.min.js')}}?v=1.0.0" type="text/javascript"></script>
<script>
    var base_url = '{{ url('/') }}';
    var lang_id = {{ LaravelLocalization::getCurrentLocaleID() }};
    var lang_code = '{{ LaravelLocalization::getCurrentLocale() }}';
    var imageAvatar = "{{ $noimage }}";
    var debug = {{ (env('APP_DEBUG')) ? 1 : 0}};
    var url_map_callback_api  = "/api/map";
    var url_map_lat_api  = "10.7546664";
    var url_map_lng_api  = "106.4150402";
    var map_click = false;
    var url_map_current, data_center, school_map_id, temp_map;
    var url_map_zoom = 14;
    var url_map_distance = '{{ $config_main[0]->configMaintranslations[0]->distance_google }}';
    Lang.setLocale('{{ LaravelLocalization::getCurrentLocale() }}');
</script>
<script src="{{asset('js/jquery.cookie.min.js')}}?v=1.0.0" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('assets/frontend/libs/slick-1.8.1/slick/slick.min.js')}}?v=1.0.0"></script>
<script src="{{asset('js/popper.min.js')}}?v=1.0.0"></script>
<script src="{{asset('js/bootstrap.min.js')}}?v=1.0.0"></script>
<script src="{{asset('assets/frontend/libs/momentjs/moment-with-locales.js')}}"></script>
<!-- [if lte IE 9]>
<script src="{{asset('js/placeholders.min.js')}}?v=1.0.0"></script><![endif] -->
<!-- <script src="{{asset('js/tooltipster.bundle.min.js')}}?v=1.0.0"></script> -->
<!-- <script src="{{asset('js/tooltipster-for-webflow.js')}}?v=1.0.0"></script> -->
<script src="{{asset('assets/frontend/libs/typeahead/jquery.typeahead.min.js')}}?v=1.0.0" type="text/javascript"></script>
<script src="{{asset('assets/frontend/libs/bootstrap-validator/validator.min.js')}}?v=1.0.0"></script>
<script src="{{asset('assets/frontend/libs/lobibox-master/dist/js/lobibox.min.js')}}?v=1.0.0"></script>
<script src="{{asset('assets/frontend/libs/jquery-bar-rating/jquery.barrating.min.js')}}?v=1.0.0"></script>
<script src="{{asset('assets/frontend/libs/clipboard/clipboard.min.js')}}?v=1.0.0"></script>
<script src="{{asset('assets/frontend/libs/readmore/readmore.js')}}?v=1.0.0"></script>
<script src="{{asset('assets/frontend/libs/button-loading/button-loading.min.js')}}?v=1.0.0"></script>
<script src="{{asset('assets/frontend/libs/skeleton/skeleton.min.js')}}?v=1.0.0"></script>
<script src="{{asset('assets/frontend/libs/slimscroll/slimscroll.min.js')}}?v=1.0.0"></script>
<script src="{{asset('assets/frontend/libs/jquery-bar-rating/jquery.barrating.min.js')}}?v=1.0.0"></script>
<script src="{{asset('assets/frontend/libs/gallery/three.min.js')}}?v=1.0.0"></script>
<script src="{{asset('assets/frontend/libs/gallery/photo-sphere-viewer.min.js')}}?v=1.0.0"></script>
<script src="{{asset('assets/frontend/libs/fancybox/ryxren.js')}}?v=1.0.0"></script>
<script src="{{asset('assets/frontend/libs/jpopup/jpopup.min.js')}}?v=1.0.0"></script>
<script src="{{asset('assets/frontend/libs/pagination/pagination.min.js')}}?v=1.0.0"></script>
<script src="{{asset('assets/frontend/libs/sweet-select/jquery.sweet-dropdown.min.js')}}?v=1.0.0"></script>
<script src="{{asset('assets/frontend/libs/fastselect/fastselect.min.js')}}?v=1.0.0"></script>
<script src="{{asset('assets/frontend/libs/jsontotable/jquery.jsontotable.min.js')}}"></script>
<script src="{{asset('assets/frontend/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('assets/frontend/libs/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.js')}}?v=1.0.0"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
@foreach($config_other as $k => $v)
    @if($v->key == 'GG_KEY_MAP')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{$v->value}}&libraries=places"></script>
    @endif
@endforeach
<script src="{{asset('assets/frontend/js/webflow.js')}}?v=1.0.0" type="text/javascript"></script>
<script src="{{asset('assets/frontend/js/map.js')}}?v=1.0.0" type="text/javascript"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-132078874-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-132078874-1');
</script>

<!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js?v=1.0.0"></script><![endif] -->
@yield('script')
</body>
</html>