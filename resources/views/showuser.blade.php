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


<script>
    $(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>

@endsection


