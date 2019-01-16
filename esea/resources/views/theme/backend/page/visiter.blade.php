@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/visiter.min.css')}}">
@endsection

@section('content')
    <h2 class="page-header">Quản lý khách tham quan</h2>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listVisiter" data-toggle="tab">Danh sách khách tham quan</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listVisiter">
                        <a class="text-green cursor-pointer posa" id="exportVisiter">
                            <i class="fa fa-file-excel"></i>
                        </a>
                        <a class="text-green cursor-pointer posa" id="addVisiter">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        <div class="alert alert-danger alert-dismissible" id="error_msg" style="display:none"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible no-display" id="alert_visiter_msg">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Thêm khách tham quan thành công.
                                </div>
                                <div class="alert alert-success alert-dismissible no-display" id="alert_visiter_msg_edit">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Cập nhật khách tham quan thành công.
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        @include('theme.backend.section.vister.table_vister')
                        @include('theme.backend.section.vister.modal_edit_vister')
                        @include('theme.backend.section.vister.table_note')
                        @include('theme.backend.section.vister.modal_reply_vister')
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
    <script src="{{asset('assets/backend/build/pages/js/visiter.js')}}"></script>
@endsection