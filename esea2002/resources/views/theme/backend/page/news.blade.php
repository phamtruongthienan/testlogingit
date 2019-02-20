@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/news.min.css')}}">
@endsection

@section('content')
    @include('theme.layout.backend.language')
    <h2 class="page-header">Quản lý bài viết</h2>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listNews" data-toggle="tab">Danh sách bài viết</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listNews">
                        <a class="text-green cursor-pointer posa" id="addNews">
                            <i class="fa fa-plus-square"></i>
                        </a>

                        @include('theme.backend.section.news.table_news')
                        @include('theme.backend.section.news.modal_add_news')
                        @include('theme.backend.section.news.modal_edit_news')
                    </div>
                    <!-- /.tab-pane -->
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
    <script src="{{asset('assets/backend/js/pages/news.min.js')}}"></script>
@endsection