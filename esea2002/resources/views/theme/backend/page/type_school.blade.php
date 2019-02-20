@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/type.min.css')}}">
@endsection

@section('content')
    @include('theme.layout.backend.language')
    <h2 class="page-header">Quản lý loại trường</h2>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listType" data-toggle="tab">Danh sách loại trường</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listType">
                        <a class="text-green cursor-pointer posa" data-lang="{{LaravelLocalization::getCurrentLocaleID()}}" id="addType">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        @include('theme.backend.section.type_school.table_type_school')
                        @include('theme.backend.section.type_school.modal_type_school')
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
    <script src="{{asset('assets/backend/js/pages/type.min.js')}}"></script>
@endsection