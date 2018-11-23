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
                <form action="login" method="post" >
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" placeholder="Enter username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Password:</label>
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

@endsection

@section('a')
<style>
    .a{
        color:red;
    }
</style>
@endsection