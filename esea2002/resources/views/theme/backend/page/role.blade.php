@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/role.min.css')}}">
@endsection

@section('content')
    <h2 class="page-header">Quản lý phân quyền</h2>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listRole" data-toggle="tab">Danh sách phân quyền</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listRole">
                        <a class="text-green cursor-pointer posa" id="addRole">
                            <i class="fa fa-plus-square"></i>
                        </a>

                        @include('theme.backend.section.role.table_role')
                        @include('theme.backend.section.role.modal_add_role')
                        @include('theme.backend.section.role.modal_edit_role')
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
    <script src="{{asset('assets/backend/js/pages/role.min.js')}}"></script>
@endsection