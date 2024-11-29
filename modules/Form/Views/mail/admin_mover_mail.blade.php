<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; ">
    <title>Meissner Entrümpelung</title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            min-width: 100% !important;
            background-color: #F2F2F2;
        }

        .my-email-body img {
            width: 32px;
        }

        .content {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #F2F2F2;
        }

        .content {
            font-family: Arial, Helvetica, sans-serif;
        }

        .btn {
            padding: 10px;
            background-color: #FBF1F1;
            margin: 25px auto;
            width: 25%;
            min-width: 200px;
            color: #000000;
            display: block;
            text-align: center
        }

        a {
            text-decoration: none
        }
    </style>
</head>

<body>
<div class="content">
    <div style="width: 100%;height: 104px;padding-top: 25px;background-color: #fff;border-bottom: 2px dotted #e8e8e8;">
        <div style="width: 100%;margin: 0 auto;text-align: center;">
        @php
            $logo_id = setting_item("logo_id");
            if(!empty($row->custom_logo)){
                $logo_id = $row->custom_logo;
            }
        @endphp
        @if($logo_id)
            <?php $logo = get_file_url($logo_id,'full') ?>
            <img style="width: 35%;" src="{{$logo}}" alt="Logo">
        @endif
            
        </div>
    </div>
    <div style="width: 550px; background-color: #FFFFFF; padding:30px 25px 50px; margin-bottom: 0px;color:#000000">
        <p>Dies ist eine <strong>UMZUGS-ANFRAGE</strong></p>

        <table border="0" width="100%" cellspacing="5" cellpadding="0">
            <tbody>
            <tr>
                <td width="25">&nbsp;</td>
                <td width="52%"><span style="font-size:120%">{{$data['reach_title'] ?? ''}} {{$data['reach_name'] ?? ''}}</span>
                </td>
                <td><span style="font-size:120%">E-Mail: <a href="mailto:{{$data['reach_email'] ?? ''}}"
                                                            target="_blank">{{$data['reach_email'] ?? ''}}</a></span><br>Tel.
                    oder Mobil: {{$data['reach_telephone'] ?? ''}}</td>
            </tr>
            </tbody>
        </table>
        <table style="background-color:#f3f3f3;font-size:130%" border="0" width="100%" cellspacing="5" cellpadding="0">
            <tbody>
            <tr>
                <td style="font-size:12px;"><strong>{{$data['moving_date'] ?? ''}}</strong> {{$data['moving_date_from'] ?? ''}}
                    - {{$data['moving_date_to'] ?? ''}}</td>
                <td style="font-size:12px;"><strong>Umzugsgut:</strong> {{$data['total_moving_object']??''}} m<sup>3</sup>
                </td>
            </tr>
            </tbody>
        </table>
        <table border="0" width="100%" cellspacing="5" cellpadding="0">
            <tbody>
            <tr>
                <td width="25">&nbsp;</td>
                <td width="33%">
                    <h3>VON:</h3>
                </td>
                <td width="33%">
                    <h3>VIA:</h3>
                </td>
                <td width="33%">
                    <h3>NACH:</h3>
                </td>
            </tr>
            <tr>
                <td width="25">&nbsp;</td>
                <td width="33%">
                    <p>{{$data['from_street'] ?? ''}}<br><span
                                style="font-size:115%">{{$data['from_postal_code'] ?? ''}} {{$data['from_city'] ?? ''}}</span><br>{{$data['from_country'] ?? ''}}
                    </p>
                </td>
                <td width="33%">
                    <p>{{$data['via_street'] ?? ''}}<br><span
                                style="font-size:115%">{{$data['via_postal_code'] ?? ''}} {{$data['via_city'] ?? ''}}</span><br>{{$data['via_country'] ?? ''}}
                    </p>
                </td>
                <td width="33%">
                    <p>{{$data['to_street'] ?? ''}}<br><span
                                style="font-size:115%">{{$data['to_postal_code'] ?? ''}} {{$data['to_city'] ?? ''}}</span><br>{{$data['to_country'] ?? ''}}
                    </p>
                </td>
            </tr>
            </tbody>
        </table>

        <hr>
        <div style="text-align:center">Meissner Entrümpelung<br><span style="color:#000000!important">Oranienburgerstr. 47</span><br>13437 Berlin<br><br>Telefon: 030 4172 3130<br><a href="mailto:info@meissner-entruempelung.de" style="color: #000000;">
        info@meissner-entruempelung.de</a><br></div>
    </div>
</div>
</body>

</html>