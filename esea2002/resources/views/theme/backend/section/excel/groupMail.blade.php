<h1>Danh sách Group Mail</h1>
<table>
    <thead>
    
    <tr>
        <th>ID</th>
        <th colspan="4">Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $key => $val)
        <tr>
            <td>{{$val->id}}</td>
            <td colspan="4">{{$val->email}}</td>
        </tr>
    @endforeach
    </tbody>
</table>