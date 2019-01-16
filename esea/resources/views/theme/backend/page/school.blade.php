@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/bower_components//jquery-bar-rating/themes/bars-movie.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/school.min.css')}}">
@endsection

@section('content')
    @include('theme.layout.backend.language')
    <h2 class="page-header">Quản lý trường học</h2>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listSchool" data-toggle="tab">Danh sách trường học</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listSchool">
                        <a class="text-green cursor-pointer posa" id="addSchool">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        <div class="alert alert-danger alert-dismissible" id="error_msg" style="display:none"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible no-display" id="alert_msg">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Thêm trường học thành công.
                                </div>
                                <div class="alert alert-success alert-dismissible no-display" id="alert_msg_edit">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> Cập nhật trường học thành công.
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        @include('theme.backend.section.school.table_school')
                        @include('theme.backend.section.school.modal_school')
                        @include('theme.backend.section.school.table_course')
                        @include('theme.backend.section.school.modal_course')
                        @include('theme.backend.section.school.table_program')
                        @include('theme.backend.section.school.modal_program')
                        @include('theme.backend.section.school.modal_facility')
                        @include('theme.backend.section.school.table_comment')
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
    <script src="{{asset('assets/backend/bower_components/jquery-bar-rating/jquery.barrating.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/media-upload.min.js')}}"></script>
    {{-- <script src="{{asset('assets/backend/js/pages/school.min.js')}}"></script> --}}
    <script src="{{asset('assets/backend/build/pages/js/school.js')}}"></script>
@endsection