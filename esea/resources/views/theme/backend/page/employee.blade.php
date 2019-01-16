@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/employee.min.css')}}">
@endsection

@section('content')
    <h2 class="page-header">Quản lý nhân viên</h2>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listEmployee" data-toggle="tab">Danh sách nhân viên</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listEmployee">
                        <a class="text-green cursor-pointer posa" id="addEmployee">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        <div class="alert alert-danger alert-dismissible" id="error_msg" style="display:none"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible no-display" id="alert_employee_msg">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Thêm nhân viên thành công.
                                </div>
                                <div class="alert alert-success alert-dismissible no-display" id="alert_employee_msg_edit">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Cập nhật nhân viên thành công.
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        @include('theme.backend.section.employee.table_employee')
                        @include('theme.backend.section.employee.modal_edit_employee')
                        @include('theme.backend.section.employee.modal_activity')
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
<script src="{{asset('assets/backend/build/pages/js/employee.js')}}"></script>
@endsection