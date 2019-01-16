@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/attribute.min.css')}}">
@endsection

@section('content')
    <h2 class="page-header">Quản lý thuộc tính</h2>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listGroupAttribute" data-toggle="tab">Danh sách nhóm thuộc tính</a></li>
                    <li><a href="#listAttribute" data-toggle="tab">Danh sách thuộc tính</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listGroupAttribute">
                        <a class="text-green cursor-pointer posa" id="addGroupAttribute">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        <div class="alert alert-danger alert-dismissible" id="error_msg" style="display:none"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible no-display" id="alert_msg">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Thêm nhóm thuộc tính thành công.
                                </div>
                                <div class="alert alert-success alert-dismissible no-display" id="alert_msg_edit">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Cập nhật nhóm thuộc tính thành công.
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        @include('theme.backend.section.attribute.table_group_attribute')
                        @include('theme.backend.section.attribute.modal_add_group_attribute')
                        @include('theme.backend.section.attribute.modal_edit_group_attribute')
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="listAttribute">
                        <a class="text-green cursor-pointer posa" id="addAttribute">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        <div class="alert alert-danger alert-dismissible" id="error_msg" style="display:none"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible no-display" id="alert_msg">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Thêm thuộc tính thành công.
                                </div>
                                <div class="alert alert-success alert-dismissible no-display" id="alert_msg_edit">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Cập nhật thuộc tính thành công.
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        @include('theme.backend.section.attribute.table_attribute')
                        @include('theme.backend.section.attribute.modal_add_attribute')
                        @include('theme.backend.section.attribute.modal_edit_attribute')
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
    <script src="{{asset('assets/backend/js/pages/attribute.min.js')}}"></script>
@endsection