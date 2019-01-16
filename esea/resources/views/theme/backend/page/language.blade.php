@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/language.min.css')}}">
@endsection

@section('content')
    @include('theme.layout.backend.language')
    <h2 class="page-header">Quản lý ngoại ngữ</h2>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listLanguage" data-toggle="tab">Danh sách ngoại ngữ</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listLanguage">
                        <a class="text-green cursor-pointer posa" data-lang="{{LaravelLocalization::getCurrentLocaleID()}}" id="addLanguage">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        @include('theme.backend.section.language.table_language')
                        @include('theme.backend.section.language.modal_add_language')
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
    <script src="{{asset('assets/backend/js/pages/language.min.js')}}"></script>
@endsection