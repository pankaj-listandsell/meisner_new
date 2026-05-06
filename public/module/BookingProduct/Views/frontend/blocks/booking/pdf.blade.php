<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; ">
    <title>Meissner Entrümpelung</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size:14px;
        }
        .container {
            width: 100%;
            max-width: 770px;
            margin: auto;
            padding: 20px;
        }
        .header, .section, .footer {
            width: 100%;
            margin-bottom: 20px;
        }
        .header img {
            width: 250px;
            padding: 10px 0;
        }
        .header .company-info {
            text-align: right;
        }
        .section-title {
            background-color: #CFDE29;
            color: #000;
            padding: 10px;
        }
        .content-table {
            width: 100%;
            margin-bottom: 0;
            border-collapse: collapse;
        }
        .content-table th, .content-table td {
            padding: 10px;
            font-size: 11pt;
        }
        .address-section img {
            width: 126px;
            padding: 10px 0;
        }
        .address-section span {
            font-weight: bold;
            font-size: 12pt;
        }
        .address-details p {
            font-size: 11pt;
            margin: 0;
        }
        .details-table, .details-table th, .details-table td {
            padding: 10px;
            font-size: 11pt;
        }
        .details-table th {
            background-color: #CFDE29;
            color: #000;
        }
        .details-table td {
            vertical-align: top;
        }
     
        .room-list1, .room-list2 {
            width: 100%;
        }
        .room-list-inner {
            display: flex;
            flex-wrap: wrap;
        }
        .room-list-inner div {
            width: 33.33%;
            box-sizing: border-box;
            padding: 5px 0;
        }
        .important {
            font-weight: bold;
        }
        .room-list > div {         
            padding: 2px;
            border-bottom: 1px solid #d3d3d3;
            padding-top: 12px;
            padding-left: 9px;
            padding-bottom: 5px;
        }

        .product_table table {
            width: 100%;
            border-collapse: collapse;
        }
        .product_table th, .product_table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .product_table th {
            text-align: left;
        }
        .product_table td {
            text-align: right;
        }
        .product_table td:first-child {
            text-align: left;
        }
        .summary-row {
            font-weight: bold;
            border-top: 2px solid #333;
            background-color: #f9f9f9;
        }

        @media only screen and (max-width: 650px) {
            .container {
                width: 100%;
                max-width: 600px;
            }
        }
    </style>
</head>

<body>
<div class="container" style="width: 100%; max-width: 770px; margin: auto; padding: 20px;">
    <table class="header" style="width: 100%; margin-bottom: 20px;">
        <tbody>
            <tr>
                <td width="50%"> 
                        <img style="padding: 10px 0;" src="https://meissner-entruempelung.de/uploads/0000/14/2025/03/04/meissner-logo.png" alt="Meissner Entrümpelung" width="250px">
                </td>
                <td class="company-info" style="text-align: right;" width="50%">Meissner Entrümpelung<br>Oranienburgerstr. 47
                <br>13437 Berlin<br>Telefon: 030 4172 3130</td>
            </tr>
        </tbody>
    </table>
    <h2 style="border-top: 1px solid #f9f9f9;">&nbsp;</h2>
    <div style="padding-left: 10px"><b>Kundendaten:</b></div>
    <table class="content-table" style="border: none; width: 100%; margin-bottom: 0; border-collapse: collapse;">
        <tbody>
            <tr>
                <td style="padding: 10px; font-size: 11pt;" width="50%">Name: {{ $row->full_name }}<br> 
                @if(!empty($row->company_name))<b>Name der Firma:</b> {{ $row->company_name }}@endif<br>
                @if(!empty($row->vat_id))<b>UST-ID:</b> {{ $row->vat_id }}@endif</td>
                <td style="text-align: right; padding: 10px; font-size: 11pt;" width="50%">E-Mail: <a href="mailto:{{$data->email ?? ''}}"target="_blank">{{$row->email ?? ''}}</a>
                <br>Tel./Mobil: {{ $row->phone ?? ''}}</td>
            </tr>
        </tbody>
    </table>
    <table class="content-table" style="border: none; width: 100%; margin-bottom: 0; border-collapse: collapse;">
        <tbody>
            <tr>
                <th style="text-align:left; color: #000; padding: 10px; font-size: 11pt;">Buchungsdatum: {{ $row->date }} | {{ $row->time }}</th>
                <th style="text-align:right; color: #000; padding: 10px; font-size: 11pt;">Geschätzter Preis: {{priceConvert($row->grand_amount)}} €</th>
            </tr>
        </tbody>
    </table>
    <table class="details-table" style="border: none; width: 100%; padding: 0; font-size: 11pt;">
        <tbody>
            <tr>
                <th style="background-color: #CFDE29; color: #000; padding: 10px; font-size: 11pt;">Entrümpelung-Daten</th>
            </tr>
        </tbody>
    </table>
    <table class="details-table"  style="border: none; width: 100%; padding: 0; font-size: 11pt;">
        <tbody>
            <tr>
                <td style="padding: 10px; font-size: 11pt;" width="50%">
                    <div><b>Adresse:</b> {{ $row->address }}</div>
                    <div><b>Stadt:</b> {{ $row->city }}</div>
                    <div><b>Postleitzahl:</b> {{ $row->zipcode }}</div>
                </td>
                <td style="padding: 10px; font-size: 11pt; vertical-align: top;" width="50%">
                    <div><b>wähle Dein Stockwerk:</b> {{ $row->building }}</div>
                    <div><b>Aufzug:</b> {{ $row->flour }}</div>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="details-table" style="border: none; width: 100%; padding: 0; font-size: 11pt;">
        <tbody>
            <tr>
                <th style="background-color: #CFDE29; color: #000; padding: 10px; font-size: 11pt;">Entrümpelung Gegenstände
                </th>
            </tr>
        </tbody>
    </table>
    <div class="room-list">
    <table class="product_table" style="width:100%">
        <tr>
            <th>Produktname</th>
            <th style="text-align:right">Menge</th>
            <th style="text-align:right">Preis</th>
        </tr>
         @foreach($detail as $item)
            <tr>
                <td>{{ $item->product_title }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ priceConvert($item->total_price) }} €</td>
            </tr>
         @endforeach
        <tr class="summary-row">
            <td style="text-align:right" colspan="2">Stücke insgesamt:</td>
            <td>{{$row->total_pieces}}</td>
        </tr>
        <tr class="summary-row">
            <td style="text-align:right" colspan="2">inkl. {{$row->vat_percent}}% MwSt.:</td>
            <td>{{priceConvert($row->vat)}} €</td>
        </tr>
        <tr class="summary-row">
            <td style="text-align:right;font-size:16px" colspan="2">Gesamtsumme:</td>
            <td style="font-size:16px">{{priceConvert($row->grand_amount)}} €</td>
        </tr>
    </table>
    </div>
    @if(!empty($row->note))
        <div style="padding: 9px;"><strong>Notiz</strong>: {{ $row->note }}</div>
    @endif
</div>
</body>
</html>
