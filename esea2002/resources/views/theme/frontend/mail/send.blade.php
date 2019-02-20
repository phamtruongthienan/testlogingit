@extends('theme.frontend.mail.main')
@section('title')
{{$title}}
@endsection
@section('content')
    <tr>
        <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
            <h1 style="margin: 0 0 10px; font-size: 25px; line-height: 30px; color: #333333; font-weight: normal;">
                {{$title}}
            </h1>
            <p style="margin: 0 0 10px;">{!!$mailsend!!}</p>

        </td>
    </tr>
    <tr>
        <td style="padding: 0 20px 20px;">
            <!-- Button : BEGIN -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: auto;">
                <tr>
                    <td class="button-td button-td-primary" style="border-radius: 4px; background: #f5f5f5;">
                    <a class="button-a button-a-primary" href="{{asset('/')}}" 
                            style="background: linear-gradient(45deg, #f04e23, #ffd600 99%); font-family: sans-serif; font-size: 15px; line-height: 15px; text-decoration: none; padding: 13px 17px; color: #ffffff; display: block; border-radius: 4px;">
                            Truy cập Esearch
                            </a>
                    </td>
                </tr>
            </table>
            <!-- Button : END -->
        </td>
    </tr>
@endsection