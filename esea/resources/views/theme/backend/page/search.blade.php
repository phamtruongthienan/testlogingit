@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/search.min.css')}}">
@endsection

@section('content')
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
                        <a class="text-green cursor-pointer posa" id="addSearch">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        <div class="alert alert-danger alert-dismissible" id="error_msg" style="display:none"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible no-display" id="alert_msg">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Thêm tìm kiếm thành công.
                                </div>
                                <div class="alert alert-success alert-dismissible no-display" id="alert_msg_edit">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Cập nhật tìm kiếm thành công.
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        @include('theme.backend.section.search.table_search')
                        @include('theme.backend.section.search.modal_add_search')
                        @include('theme.backend.section.search.modal_edit_search')
                        @include('theme.backend.section.search.modal_add_priority')
                        @include('theme.backend.section.search.modal_edit_priority')
                        @include('theme.backend.section.search.modal_add_school')
                        @include('theme.backend.section.search.modal_edit_school')
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
    <script src="{{asset('assets/backend/js/pages/search.min.js')}}"></script>
@endsection