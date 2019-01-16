@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/customer.min.css')}}">
@endsection

@section('content')
    <h2 class="page-header">Quản lý khách hàng</h2>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listCustomer" data-toggle="tab">Danh sách khách hàng</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listCustomer">
                        <a class="text-green cursor-pointer posa" id="addCustomer">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        <div class="alert alert-danger alert-dismissible" id="error_msg" style="display:none"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible no-display" id="alert_customer_msg">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Thêm khách hàng thành công.
                                </div>
                                <div class="alert alert-success alert-dismissible no-display" id="alert_customer_msg_edit">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Cập nhật khách hàng thành công.
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        @include('theme.backend.section.customer.table_customer')
                        @include('theme.backend.section.customer.modal_edit_customer')
                        @include('theme.backend.section.customer.table_child')
                        @include('theme.backend.section.customer.modal_edit_child')
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
    <script src="{{asset('assets/backend/js/pages/customer.min.js')}}"></script>
@endsection