@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/search.min.css')}}">
@endsection

@section('content')
    @include('theme.layout.backend.language')
    <h2 class="page-header">Quản lý tìm kiếm</h2>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listSearch" data-toggle="tab">Danh sách tìm kiếm</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listSearch">
                        <a class="text-green cursor-pointer posa" data-lang="{{LaravelLocalization::getCurrentLocaleID()}}" id="addSearch">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        @include('theme.backend.section.search.table_search')
                        @include('theme.backend.section.search.modal_add_search')
                        @include('theme.backend.section.search.modal_add_priority')
                        @include('theme.backend.section.search.modal_add_school')
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
    <script src="{{asset('assets/backend/build/pages/js/search.js')}}"></script>
@endsection