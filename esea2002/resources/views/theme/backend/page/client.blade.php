@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/bower_components/typeahead/jquery.typeahead.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/partner.min.css')}}">
@endsection

@section('content')
    @include('theme.layout.backend.language')
    <h2 class="page-header">Quản lý đối tác</h2>
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listPartner" data-toggle="tab">Danh sách đối tác</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listPartner">
                        <a class="text-green cursor-pointer posa" id="addPartner">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        @include('theme.backend.section.client.table_client')
                        @include('theme.backend.section.client.modal_client')
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
    <script src="{{asset('assets/backend/bower_components/typeahead/jquery.typeahead.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/partner.min.js')}}"></script>
@endsection