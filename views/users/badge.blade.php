<html>
<head>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        @media print {
            html, body {
                width: 210mm;
                height: 297mm;
            }
        }
        html,body { padding: 0; }
    </style>
</head>
<body>
    <table style="width: 86mm; height: 53mm; border: solid 1px grey; ">
        <tr>
            <td style="width: 110px; text-align: left; padding-left: 15px">
                <img src="{!!Gravatar::src($user->email, 80)!!}" alt="{{$user->first_name.' '.$user->last_name}}">
                <br>
                <img src="data:image/png;base64, {{ base64_encode(\QrCode::format('png')->size(80)->margin(0)->generate($user->getHash())) }} ">
            </td>
            <td style="text-align: center"><strong>{{$user->first_name.' '.$user->last_name}}</strong> <br> <small>{{$user->job_title}}</small></td>
        </tr>
    </table>

</body>
</html>
