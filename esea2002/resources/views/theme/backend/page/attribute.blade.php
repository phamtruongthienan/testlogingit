@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/attribute.min.css')}}">
@endsection

@section('content')
    @include('theme.layout.backend.language')
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
                        <a class="text-green cursor-pointer posa" data-lang="{{LaravelLocalization::getCurrentLocaleID()}}" id="addGroupAttribute">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        @include('theme.backend.section.attribute.table_group_attribute')
                        @include('theme.backend.section.attribute.modal_add_group_attribute')
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="listAttribute">
                        <a class="text-green cursor-pointer posa" data-lang="{{LaravelLocalization::getCurrentLocaleID()}}" id="addAttribute">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        @include('theme.backend.section.attribute.table_attribute')
                        @include('theme.backend.section.attribute.modal_add_attribute')
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
    <script src="{{asset('assets/backend/build/pages/js/attribute.js')}}"></script>
@endsection