<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
</head>
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
                @if(isset($comment))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                     {{$comment}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
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
                    required: "Vui lòng nhập mật khẩu",
                    minlength: "Mật khẩu  quá ngắn",
                    maxlength:"Mật khẩu quá dài"
                }
            }
        });
    });
    </script>

