@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/event.min.css')}}">
@endsection

@section('content')
    @include('theme.layout.backend.language')
    <h2 class="page-header">Quản lý sự kiện</h2>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listEvent" data-toggle="tab">Danh sách event</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listEvent">
                        <a class="text-green cursor-pointer posa" data-lang="{{LaravelLocalization::getCurrentLocaleID()}}" id="addEvent">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        @include('theme.backend.section.event.table_event')
                        @include('theme.backend.section.event.modal_add_event')
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
    <script src="{{asset('assets/backend/build/pages/js/event.js')}}"></script>
@endsection