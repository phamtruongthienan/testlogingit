@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/menu.min.css')}}">
@endsection

@section('content')
@include('theme.layout.backend.language')
    <h2 class="page-header">Quản lý menu</h2>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listMenu" data-toggle="tab">Danh sách menu</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listMenu">
                        <a class="text-green cursor-pointer posa" id="addMenu">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        @include('theme.backend.section.menu.table_menu')
                        @include('theme.backend.section.menu.modal_add_menu')
                        @include('theme.backend.section.menu.modal_edit_menu')
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
    <script src="{{asset('assets/backend/js/pages/menu.min.js')}}"></script>
@endsection