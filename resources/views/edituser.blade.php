@extends('wrapper')
@section('content')

<body>
<input type="text" name="" id="" value="thienan">
<table id="table_id" class="display">
    <thead>
        <tr>
            <th>Username</th>
            <th>Password</th>
        </tr>
    </thead>
    <tbody>
        {{$data}}
    @foreach($data as $product)
        <tr>
            <td> <input type="text" class="txtuser" data-id="{{$product['id']}}"   value="{{$product['username']}}"></td>
            <td><input type="text" class="txtpass" name="" id="" value="{{$product['raw_password']}}"></td>
        </tr>
    @endforeach   
    </tbody>
</table>


    </body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>

<script>
    $(document).ready(function(){
        var timeout = null;
        $('.txtuser').on('keyup',function () {
            var idUser = $(this).attr('data-id')
           var value = $(this).val()
           clearTimeout(timeout);
            timeout = setTimeout(function () {
                $.ajax({
                    url: 'editusers', 
                    type:'post',
                    data: {
                            "id":idUser,
                            value,
                            "_token":"{{csrf_token()}}"
                    },
                    success:function(res){
                        console.log(res)
                    },
                    error:function(error){
                        console.log(error)
                    }
                })
                
            },1000);
        })
        
    })
</script>


@endsection


