
<style>
    .aflex-404 {
    max-width: 800px;
    margin: auto;
    margin-top: 80px;
    text-align: center;
}

.aflex-404 img {
    width: 100%;
}
</style>
<link rel="stylesheet" href="https://dv1-meissner.shop-template.de/assests/css/general.css">
<div class="aflex-404">
        @php
            $logo_id = setting_item("logo_id");
            if(!empty($row->custom_logo)){
                $logo_id = $row->custom_logo;
            }
        @endphp
        @if($logo_id)
            <?php $logo = get_file_url($logo_id,'full') ?>
            <div class="logo">
                <a href="/"><img alt="logo" src="{{$logo}}" style="width:255px"></a>
            </div>
        @endif

    <h1 style="font-family:'Montserrat'">Diese Seite konnte nicht gefunden werden!</h1>
    <img src="/uploads/0000/1/2024/09/23/404-error-meissner-n.webp">
    <p style="    margin-bottom: 23px;
    font-size: 20px;
    font-family: Open Sans;
    line-height: 1.5;
    margin-top: 7px;">Es tut uns leid, aber die Seite, die du suchst, existiert nicht. Vielleicht versuchst du es mit einer erneuten Suche.</p>
    <div class="anfrage-col listandsell-button error-btn">
            <a style="background:#2A343F;
                color: white;
                text-decoration: none;
                padding: 12px 17px;
                display: block;
                width: 172px;
                margin: auto;
                font-size: 18px;
                font-weight: 500;
                line-height: 27px;
                border-radius: 10px;" href="/"> Startseite </a>
    </div>
</div>
