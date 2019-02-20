@extends('theme.layout.backend.main')

@section('content')
@include('theme.layout.backend.language')
    <div class="inline-block">
        <h2 class="page-header">Thống kê</h2>
    </div>
    <div class="inline-block margin-left-10">
            <select class="form-control select2" id="changeTime" name="time">
                <option data-href="{{route('admin.chart')}}?time=day" value="day" @if(app('request')->input('time') == 'day') selected @endif>Thống kê ngày</option>      
                <option data-href="{{route('admin.chart')}}?time=week" value="week" @if(app('request')->input('time') == 'week') selected @endif>Thống kê tuần</option>      
                <option data-href="{{route('admin.chart')}}?time=month" value="month" @if(app('request')->input('time') == 'month') selected @endif>Thống kê tháng</option>      
                <option data-href="{{route('admin.chart')}}?time=year" value="year" @if(app('request')->input('time') == 'year') selected @endif>Thống kê năm</option>         
            </select>
    </div>

    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-registered" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Số lượng khách hàng đăng ký</span>
                <span class="info-box-number">{{$count_customer}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-search" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Số lượng từ khóa tìm kiếm phổ biến</span>
                    <span class="info-box-number">{{$count_keyword}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-cart-plus" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Số lượng book tham quan</span>
                    <span class="info-box-number">{{$count_booking}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#registration"  data-id="1" class="tab_ajax" data-toggle="tab">Thống kê khách hàng</a></li>
                    <li><a href="#search"  data-id="2" class="tab_ajax" data-toggle="tab">Thống kê từ khóa tìm kiếm</a></li>
                    <li><a href="#view"  data-id="3" class="tab_ajax" data-toggle="tab">Thống kê các trường theo số lần xem</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="registration">
                        <!-- BAR CHART -->
                        <h2>Đăng ký</h2>
                        <div class="box-body">
                            {!! $chart_customer->container() !!}
                        </div>
                        <h2>Tham quan</h2>
                        <div class="box-body">
                                {!! $chart_booking->container() !!}
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="search">
                        <!-- BAR CHART -->
                        <div class="box-body">
                            <div class="control-row table-responsive">
                                <table class="table table-bordered table-striped table-dynamic table-dynamic-search nowrap"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="text-center" width="100px">ID</th>
                                        <th class="text-center">Từ khóa tìm</th>
                                        <th class="text-center" width="300px">Số lần tìm</th>
                                        <!-- <th class="text-center" width="200px"></th> -->
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="view">
                        <!-- BAR CHART -->
                        <div class="box-body">
                            <div class="control-row table-responsive">
                                <table class="table table-bordered table-striped table-dynamic table-dynamic-view nowrap"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="text-center" width="100px">ID</th>
                                        <th class="text-center">Tên trường</th>
                                        <th class="text-center" width="300px">Số lần xem</th>
                                        <!-- <th class="text-center" width="200px"></th> -->
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

  

@endsection

@section('script')
    {!! $chart_booking->script() !!}
    {!! $chart_customer->script() !!}
    <script src="{{asset('assets/backend/js/pages/chart.min.js')}}"></script>
@endsection