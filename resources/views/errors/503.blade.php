<html>
<head>
    <title>{{ setting_item_with_lang("site_title") }}</title>
    <META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
    <style>
        body { text-align: center; padding: 150px; }
        article.maint-art {
            text-align: center;
        }
        h1 { font-size: 50px;    color: #cfde29; }
        body { font: 20px Helvetica, sans-serif; color: #333; }
        article { display: block; text-align: left; width: 650px; margin: 0 auto; }
        a { color: #dc8100; text-decoration: none; }
        a:hover { color: #333; text-decoration: none; }
        h6 {
            margin-bottom: 0;
            font-size: 27px;
            margin-top: 5px;
        }
        p.envelptxt {
            font-size: 23px;
            font-style: italic;
        }
        .mailclassicon {
            color: #2a343f;
        }
        @media only screen and (max-width:1025px) {
            body{
                padding: 47px;
            }
            h1{
                font-size: 33px;
            }
            .maint-logo{
                width: 222px;
            }
        }
    </style>
</head>
<body>
    @php
            $logo_id = setting_item("logo_id");
            if(!empty($row->custom_logo)){
                $logo_id = $row->custom_logo;
            }
        @endphp
        @if($logo_id)
            <?php $logo = get_file_url($logo_id,'full') ?>
            <img src="{{$logo}}" alt="logo" width="250" class="maint-logo">
        @endif

<h1>Wartungsmodus</h1>
<div>
    <p>Die Seite steht demnächst wieder zur Verfügung. Danke für Ihre Geduld!</p>
    <p>— {{ setting_item_with_lang("site_title") }}</p>
    <h6>Kontakt</h6>
    <p class="envelptxt">Email: <a href="mailto:{{ setting_item_with_lang("email") }}" class="mailclassicon">{{ setting_item_with_lang("email") }}</a></p>
    <p class="envelptxt">Tel: <a href="tel:{{ setting_item_with_lang("phone_no_link") }}" class="mailclassicon">{{ setting_item_with_lang("phone_no") }}</a></p>
    <p class="envelptxt">Adresse: <span class="mailclassicon">{{ setting_item_with_lang("address") }}</span></p>

</div>
</body>
</html>
