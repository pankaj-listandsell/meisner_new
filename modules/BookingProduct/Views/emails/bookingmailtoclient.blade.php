@extends('Email::layout')
@section('content')
    <div style="">
        <h5>Dear {{$data->full_name}},</h5>
        <p>Vielen Dank für Ihre Produktbuchung.</p>
        <div class="my-4">
            <h5>Buchungs-ID : {{$data->booking_id}}</h5>
            <p><strong>Adresse : </strong><br>
                {{$data->address}}<br>
                {{$data->city}}, {{$data->zipcode}}
            </p>
            <p>Vollständiger Name : {{$data->full_name}}</p>
            <p>E-Mail : {{$data->email}}</p>
            <p>Telefon : {{$data->phone}}</p>
            <p>USt-ID : {{$data->vat_id}}</p>
            <p>E-Mail : {{$data->email}}</p>
            <p>Buchungsdatum : {{ display_date($data->date)}}</p>

        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr style="border: 1px solid black;">
                        <th style="border: 1px solid black;">Bild</th>
                        <th style="border: 1px solid black;">Produkt</th>
                        <th class="text-center" style="border: 1px solid black;">QTY</th>
                        <th class="text-right" style="border: 1px solid black;">Preis pro Einheit</th>
                        <th class="text-right" style="border: 1px solid black;">Insgesamt</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detail as $val)
                    <?php
                    $image_url = get_file_url($val->image_id, 'full');
                    $image_details = get_file_details($val->image_id, '#');
                    ?>
                    <tr>
                        <td style="border: 1px solid black;"><img style="height: 50px;width: 50px" src="{{$image_url}}" title="Container zur Gewerbemüllentsorgung bestellen" alt="Container zur Gewerbemüllentsorgung bestellen"></td>
                        <td style="border: 1px solid black;">{{$val->product_title}}</td>
                        <td class="text-center" style="border: 1px solid black;">{{$val->qty}}</td>
                        <td class="text-right" style="border: 1px solid black;">{{priceConvert($val->unit_price)}} €</td>
                        <td class="text-right" style="border: 1px solid black;">{{priceConvert($val->total_price)}} €</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <table class="table">
                    <tr>
                        <th>Stücke insgesamt:</th>
                        <td>{{$data->total_pieces}}</td>
                    </tr>
                    <tr>
                        <th>Nettobetrag:</th>
                        <td>{{priceConvert($data->net_amount)}} €</td>
                    </tr>
                    <tr>
                        <th>Vat :({{$data->vat_percent}} %)</th>
                        <td>{{priceConvert($data->vat)}} €</td>
                    </tr>
                    <tr>
                        <th>Zusätzliche Kosten einschließlich Mehrwertsteuer:</th>
                        <td>{{priceConvert($data->additional_cost)}} €</td>
                    </tr>
                    <tr class="table-active">
                        <th>Insgesamt:</th>
                        <td class="text-right font-weight-bold">{{priceConvert($data->grand_amount)}} €</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <p class="font-italic">Thank you for your purchase!</p>
        </div>
    </div>
@endsection
