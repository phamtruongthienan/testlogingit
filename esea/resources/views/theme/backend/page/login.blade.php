<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('assets/backend/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/bower_components/iCheck/square/blue.css')}}">
    <style>
        .login-box {
            margin-top: 0;
            padding-top: 7%;
        }
    </style>

    <!--[if lt IE 9]>
    <script src="{{asset('assets/backend/js/html5shiv.js')}}"></script>
    <script src="{{asset('assets/backend/js/respond.min.js')}}"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{asset('/')}}"><b>E</b>Search</a>
    </div>
    <!-- /.login-logo -->
    @if ( $errors->count() > 0 )
        @foreach( $errors->all() as $message )
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @endforeach
    @endif
    <div class="login-box-body">
        <div class="alert alert-danger alert-dismissible" id="error_msg" style="display:none"></div>
        <form id="login-form" role="form" data-toggle="validator" action="{{ route('admin.login.action') }}" method="POST">
            {!! csrf_field() !!}
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="email" placeholder="Username"
                       required>
                <input type="hidden" class="form-control" name="device" value="{{ Request::ip() }}" required>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password"
                       placeholder="Password" required>
                <div class="help-block with-errors"></div>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block"
                            data-loading-text="<i class='fa fa-spinner fa-spin '></i> {{ trans('common.processing') }}">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="{{asset('assets/backend/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/backend/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/backend/bower_components/iCheck/icheck.min.js')}}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>