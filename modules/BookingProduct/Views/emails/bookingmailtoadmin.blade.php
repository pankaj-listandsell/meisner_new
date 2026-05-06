<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; " />
        <title>Meissner Entrümpelung</title>
        <style type="text/css">
            body {
                margin: 0;
                padding: 0;
                min-width: 100% !important;
                background-color: #f2f2f2;
            }
            .my-email-body img {
                width: 32px;
            }
            .content {
                width: 100%;
                max-width: 600px;
                margin: 0 auto;
                border: 1px solid #f2f2f2;
            }
            .btn {
                padding: 10px;
                background-color: #fbf1f1;
                margin: 25px auto;
                width: 25%;
                min-width: 200px;
                color: #000000;
                display: block;
                text-align: center;
            }
            a {
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <div style="width: 100%; height: 50px; padding-top: 25px; background-color: #fff;">
                <div style="margin: 0 auto; text-align: center;">
                    <img width="250" src="https://meissner-entruempelung.de/uploads/0000/14/2025/03/04/meissner-logo.png" alt="Meissner Entrümpelung" />
                </div>
            </div>
            <div style="width: 550px; background-color: #ffffff; padding: 50px 25px 50px; margin-bottom: 0px; color: #000000;">
                <p>Sie haben eine neue Anfrage über den Entrümpelungs-Recher erhalten.</p>
                <p>Anbei finden Sie die PDF-Datei mit der vollständigen Zusammenfassung der Anfrage.</p>
                <p>Allgemeine Daten:</p>
                <p>
                    <b>Kunde:</b> {{$data->full_name}}<br>
                    <b>E-Mail:</b> {{$data->email}}<br>
                    <b>Telefon:</b> {{$data->phone}}<br>
                    <b>Gesamtsumme:</b> {{priceConvert($data->grand_amount)}} €
                </p>
                <p>Schöne Grüße</p>
                <hr style="border-color: #0000001c">
                <div style="text-align: center;">
                    <strong>Meissner Entrümpelung</strong><br />
                    <span style="color: #000000 !important;">Oranienburgerstr. 47</span><br/>
                    13437 Berlin<br/>
                    Deutschland<br/>
                    <br />
                    Telefon: 030 4172 3130<br />
                    <a href="mailto:info@meissner-entruempelung.de" style="color: #000000;"> info@meissner-entruempelung.de</a><br />
                </div>
            </div>
        </div>
    </body>
</html>
