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
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 ">
                <h2 class="text-center">Change Password</h2>
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
                <form action="change" method="post" >
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" placeholder="Enter username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">Current Password :</label>
                        <input type="password" name="currentpassword" placeholder="Enter current password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">New Password:</label>
                        <input type="password" name="password" placeholder="Enter new password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">Confirm:</label>
                        <input type="password" name="confirm" placeholder="Enter confirm" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Change Password</button>
                    </div>
                    {!! csrf_field() !!}
                </form>
            </div>
        </div>
    </div>
</body>

@endsection

@section('a')
<style>
    .a{
        color:red;
    }
</style>
@endsection