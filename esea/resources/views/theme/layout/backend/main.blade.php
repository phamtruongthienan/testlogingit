<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdminLTE 2 | General UI</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @yield('meta')
    @include('theme.layout.backend.main_css')
    <link href="{{asset('assets/backend/img/favicon.png')}}?v=1.0.0" rel="shortcut icon" type="image/x-icon">
    <link href="{{asset('assets/backend/img/webclip.png')}}?v=1.0.0" rel="apple-touch-icon">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('theme.layout.backend.header')
        @include('theme.layout.backend.menu')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <!-- START CUSTOM TABS -->
                @yield('content')
                <!-- END CUSTOM TABS -->
            </section>
            <!-- /.content -->
        </div>

        @include('theme.layout.backend.footer')
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->
    @include('theme.layout.backend.main_js')
</body>
</html>