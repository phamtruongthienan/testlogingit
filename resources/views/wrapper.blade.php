@yield('a') 
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

</head>
<!-- <a href="login">login</a> -->

<a href="showuser" class="close"  aria-label="Close" style="margin-right:2rem; float:left;    ">Xem tất cả  User</a>
<a href="regis" class="close"  aria-label="Close" style="margin-right:2rem; float:left;    ">Thêm User</a>
<a href="edituser" class="close"  aria-label="Close" style="margin-right:2rem; float:left;    ">Xóa User</a>
<a href="edituser" class="close"  aria-label="Close" style="margin-right:2rem; float:left;    ">Sửa  User</a>

{{Auth::user()->username}}
@if(isset($infor))
                <div class="alert alert-warning alert-dismissible fade show col-4" role="alert">
                     {{$infor}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                </div> 
<div> @yield('content')</div> 
</html>


<!-- <div class="a">footer</div> -->