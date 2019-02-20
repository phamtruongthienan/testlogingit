@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/localization.min.css')}}">
@endsection

@section('content')
    <h2 class="page-header">Quản lý từ vựng</h2>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listLocalization" data-toggle="tab">Danh sách từ vựng</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listLocalization">
                        <a class="text-green cursor-pointer posa" id="addLocalization">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        <div class="alert alert-danger alert-dismissible" id="error_msg" style="display:none"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible no-display" id="alert_msg">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Thêm từ vựng thành công.
                                </div>
                                <div class="alert alert-success alert-dismissible no-display" id="alert_msg_edit">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Cập nhật từ vựng thành công.
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-4 no-padding-left">
                                    <select class="form-control select2" style="width: 100%;" id="inputAddPosition">
                                        <option selected>Tiếng việt</option>
                                        <option>Tiếng anh</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @include('theme.backend.section.localization.table_localization')
                        @include('theme.backend.section.localization.modal_add_localization')
                        @include('theme.backend.section.localization.modal_edit_localization')
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
    <script src="{{asset('assets/backend/js/pages/localization.min.js')}}"></script>
@endsection