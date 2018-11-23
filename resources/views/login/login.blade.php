@extends('wrapper')
@section('content')
<!-- <div>
    <form action="{{route('login')}}" method="post">
        Username:<input type="text"  name="username">
        password: <input type="password" name="password">
        <button type="submit">Login</button>
        {!! csrf_field() !!}
    </form>
</div> -->
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<style>
#password-error{
    color: #856404;
    background-color: #fff3cd;
    border-color: #ffeeba;
}
#username-error{
    color: #856404;
    background-color: #fff3cd;
    border-color: #ffeeba;
}
</style>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 ">
                <h2 class="text-center">Login</h2>
                <?php
                if(isset($_SESSION['error'])):
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                endif            
                ?>
                <form action="login" method="post" class="formLogin">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" placeholder="Enter username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" placeholder="Enter password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="rememeber" name="remember" value="1">
                        <label for="rememeber">Remember me</label>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Login</button>
                    </div>
                    {!! csrf_field() !!}
                </form>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
 
    $(document).ready(function() {
 
        //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
        $(".formLogin").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 5,
                    maxlength: 15
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                }
            },
            messages: {
                username: {
                    required: "Vui lòng nhập tài khoản",
                    minlength: "Tài khoản quá ngắn",
                    maxlength:"Tài khoản quá dài"
                },
                password: {
                    required: "Vui lòng nhập tài khoản",
                    minlength: "Mật khẩu  quá ngắn",
                    maxlength:"Mật khẩu quá dài"
                }
            }
        });
    });
    </script>

@endsection

@section('a')
<style>
    .a{
        color:red;
    }
</style>
@endsection