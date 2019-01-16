@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/setting.min.css')}}">
@endsection

@section('content')
    @include('theme.layout.backend.language')
    <h2 class="page-header">Quản lý thông tin về eSearch</h2>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#information" data-toggle="tab">Thông tin chung</a></li>
                    <li><a href="#seo" data-toggle="tab">Thông tin SEO</a></li>
                    <li><a href="#social" data-toggle="tab">Thông tin mạng xã hội</a></li>
                    <li><a href="#language" data-toggle="tab">Thông tin ngôn ngữ</a></li>
                </ul>
                <div class="tab-content">
                    @include('theme.backend.section.setting.info.tab_info')
                    @include('theme.backend.section.setting.seo.tab_seo')
                    @include('theme.backend.section.setting.social.tab_social')
                    @include('theme.backend.section.setting.language.tab_language')
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    @include('theme.layout.backend.modal_confirm_delete')
@endsection

@section('script')
    <script src="{{asset('assets/backend/js/pages/setting.min.js')}}"></script>
@endsection