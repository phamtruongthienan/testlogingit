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