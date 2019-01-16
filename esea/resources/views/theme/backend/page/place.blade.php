@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/place.min.css')}}">
@endsection

@section('content')
    <h2 class="page-header">Quản lý địa điểm</h2>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listPlace" data-toggle="tab">Danh sách địa điểm</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listPlace">
                        <a class="text-green cursor-pointer posa" id="addCity">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        <div class="alert alert-danger alert-dismissible" id="error_msg" style="display:none"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible no-display" id="alert_msg">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> <span></span>
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        @include('theme.backend.section.place.table_place')
                        @include('theme.backend.section.place.modal_add_city')
                        @include('theme.backend.section.place.modal_edit_city')
                        @include('theme.backend.section.place.modal_add_district')
                        @include('theme.backend.section.place.modal_add_ward')
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
    <script src="{{asset('assets/backend/js/pages/place.min.js')}}"></script>
@endsection