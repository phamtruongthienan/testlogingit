@extends('wrapper')
@section('content')

<body>

<table id="table_id" class="display">
    <thead>
        <tr>
            <th>Username</th>
            <th>Password</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $product)
        <tr>
            <td>{{$product['username']}}</td>
            <td>{{$product['raw_password']}}</td>
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

@endsection


