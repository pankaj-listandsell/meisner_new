<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; ">
    <title>{{ setting_item_with_lang("site_title") }}</title>
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
            margin-top: 50px;
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
            <img style="width: 35%;" src="{{$logo}}" alt="meiser-logo">
        @endif

        </div>
    </div>
    <div style="width: 550px; background-color: #FFFFFF; padding:30px 25px 50px; margin-bottom: 0px;color:#000000">

        @yield('content')

        <hr style="border-color:#fff">
        <div style="text-align:center">{{ setting_item_with_lang("site_title") }}<br><span style="color:#000000!important">{{ setting_item_with_lang("address") }}<br><br>Telefon: {{ setting_item_with_lang("phone_no") }}<br><a href="mailto:{{ setting_item_with_lang("email") }}" style="color: #000000;">
                {{ setting_item_with_lang("email") }}</a><br></div>
    </div>
</div>
</body>

</html>
