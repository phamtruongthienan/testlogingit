@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/popup.min.css')}}">
@endsection

@section('content')
    @include('theme.layout.backend.language')
    <h2 class="page-header">Quản lý quảng cáo</h2>
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listAdvertise" data-toggle="tab">Danh sách quảng cáo</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listAdvertise">
                        <a class="text-green cursor-pointer posa" id="addAdvertise">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        <div class="alert alert-danger alert-dismissible" id="error_msg" style="display:none"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible no-display" id="alert_msg">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Thêm quảng cáo thành công.
                                </div>
                                <div class="alert alert-success alert-dismissible no-display" id="alert_msg_edit">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Cập nhật quảng cáo thành công.
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        @include('theme.backend.section.advertise.table_advertise')
                        @include('theme.backend.section.advertise.modal_advertise')
                     
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
    <script src="{{asset('assets/backend/js/pages/popup.min.js')}}"></script>
@endsection