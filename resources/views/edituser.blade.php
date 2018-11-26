@extends('wrapper')
@section('content')

<body>

    <!-- @if(isset($comment))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                     {{$comment}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif -->
    <div class="alert alert-warning alert-dismissible fade show" id="comment" role="alert" style="height=50px;float:left;"></div>

    <table id="table_id" class="display">
        <thead>
            <tr>
                <th>Username</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <!-- {{$data}} -->
            @foreach($data as $product)
            <tr id="remove-{{$product['id']}}">
                <td> <input type="text" class="txtuser" data-id="{{$product['id']}}" value="{{$product['username']}}"></td>
                <td><input type="text" class="txtpass" data-id="{{$product['id']}}" value="{{$product['raw_password']}}">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" data-id="{{$product['id']}}" style="font-size: 1rem;margin-right:3rem;">Xóa
                        </span>
                    </button>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
<style>
    input{width:850px;
            background-color: #f1f1f1;
            border: none;
            }
    </style>

<script>
    $(document).ready(function () {
        $('#table_id').DataTable();
    });
</script>

<script>
    $(document).ready(function () {
        $('#comment').hide()
        // var timeout = null;
        $('.txtuser').change('keyup', function () {
            var idUser = $(this).attr('data-id')
            var valueUser = $(this).val()
            $.ajax({
                url: 'editusers',
                type: 'post',
                // dataType:"json",
                data: {
                    "id": idUser,
                    valueUser,
                    "_token": "{{csrf_token()}}"
                },
                success: function (res) {
                    $('#comment').html(res.comment)
                    $('#comment').show()

                    // console.log(res)
                },
                error: function (error) {
                    console.log(error)
                }
            })
        })
        $('.txtpass').change('keyup', function () {
            var idUser = $(this).attr('data-id')
            var valuePass = $(this).val()
            $.ajax({
                url: 'editusers',
                type: 'post',
                dataType: "json",
                data: {
                    "id": idUser,
                    valuePass,
                    "_token": "{{csrf_token()}}"
                },
                success: function (res) {
                    $('#comment').html(res.comment)
                    $('#comment').show()
                    // console.log(res)
                },
                error: function (error) {
                    console.log(error)
                }
            })
        })
        $('.close span').click(function () {
            var idUser = $(this).attr('data-id')
            $.ajax({
                url: 'editusers',
                type: 'post',
                dataType: "json",
                data: {
                    "id": idUser,
                    "_token": "{{csrf_token()}}"
                },
                success: function (res) {
                    $('#comment').html(res.comment)
                    $('#comment').show()
                    $('#remove-' + idUser).hide(500)
                  
                    // console.log(res)
                },
                error: function (error) {
                    console.log(error)
                }
            })
        })

    })
</script>


@endsection