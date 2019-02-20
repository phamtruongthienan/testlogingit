@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/email.min.css')}}">
@endsection

@section('content')
    <h2 class="page-header">Quản lý thông tin về Email</h2>
    <div class="row">
        <div class="col-md-12">
            @include('theme.backend.section.email.form_send_email')
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#account" data-toggle="tab">Thông tin email account</a></li>
                    <li><a href="#email" data-toggle="tab">Thông tin email khách hàng</a></li>
                </ul>
                <div class="tab-content">
                    @include('theme.backend.section.email.account.tab_email_account')
                    @include('theme.backend.section.email.customer.tab_email_customer')
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
    <script src="{{asset('assets/backend/js/pages/email.min.js')}}"></script>
@endsection