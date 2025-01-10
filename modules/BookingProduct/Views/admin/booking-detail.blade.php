@extends('admin.layouts.app')
<style>
    .invoice-container {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        /* max-width: 1000px; */
        margin: auto;
    }
    .invoice-header {
        background-color: #343a40;
        color: #ffffff;
        padding: 15px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        margin-bottom: 20px;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .from-section {
        background-color: #e9ecef;
        padding: 15px;
        border-radius: 8px;
        height: 100%;
    }
</style>
@section('content')
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">Buchung Detail</h1>
                </div>

            </div>
            <div class="lang-content-box">
                    <div class="invoice-container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="from-section">
                                    <h5>Buchungs-ID : {{$row->booking_id}}</h5>
                                    <p><strong>{{__('Adresse')}} : </strong> {{$row->address.', '.$row->zipcode.', '.$row->city}}</p>
                                    {{-- <p><strong>Stadt : </strong> {{ $row->city}}</p>
                                    <p><strong>Postleitzahl : </strong> {{ $row->zipcode}}</p> --}}
                                    <p><strong>Vollständiger Name : </strong> {{ $row->full_name}}</p>
                                    <p><strong>E-Mail : </strong> {{ $row->email}}</p>
                                    <p><strong>Telefon : </strong> {{ $row->phone}}</p>
                                    <p><strong>Name des Unternehmens : </strong> {{ $row->company_name}}</p>
                                    <p><strong>USt-ID : </strong> {{ $row->vat_id}}</p>

                                    <p><strong>Buchungsdatum : </strong> {{ display_date($row->date)}}</p>
                                    <p><strong>Buchungszeit : </strong> {{$row->time}}</p>
                                    <p><strong>Gebäude : </strong> {{$row->building}}</p>
                                    <p><strong>Mehl : </strong> {{$row->flour}}</p>
                                    <p><strong>Anmerkungen : </strong> {{$row->note}}</p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Bild</th>
                                                <th>Produkt</th>
                                                <th class="text-center">QTY</th>
                                                <th class="text-right">Preis pro Einheit</th>
                                                <th class="text-right">Insgesamt</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detail as $val)
                                            <?php
                                            $image_url = get_file_url($val->image_id, 'full');
                                            $image_details = get_file_details($val->image_id, '#');
                                            ?>
                                            <tr>
                                                <td><img style="height: 50px;width: 50px" src="{{$image_url}}" title="Container zur Gewerbemüllentsorgung bestellen" alt="Container zur Gewerbemüllentsorgung bestellen"></td>
                                                <td>{{$val->product_title}}</td>
                                                <td class="text-center">{{$val->qty}}</td>
                                                <td class="text-right">{{priceConvert($val->unit_price)}} €</td>
                                                <td class="text-right">{{priceConvert($val->total_price)}} €</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                
                                <table class="table">
                                    <tr>
                                        <th>Stücke insgesamt:</th>
                                        <td class="text-right">{{$row->total_pieces}}</td>
                                    </tr>
                                    <tr>
                                        <th>Nettobetrag:</th>
                                        <td class="text-right">{{priceConvert($row->net_amount)}} €</td>
                                    </tr>
                                    <tr>
                                        <th>Vat :</th>
                                        <td class="text-right">{{priceConvert($row->vat)}} €</td>
                                    </tr>
                                    <tr>
                                        <th>Zusätzliche Kosten einschließlich Mehrwertsteuer:</th>
                                        <td class="text-right">{{priceConvert($row->additional_cost)}} €</td>
                                    </tr>
                                    <tr class="table-active">
                                        <th>Insgesamt:</th>
                                        <td class="text-right font-weight-bold">{{priceConvert($row->grand_amount)}} €</td>
                                    </tr>
                                </table>
                
                                {{-- <div class="text-center mt-4">
                                    <p class="font-italic">Thank you for your purchase!</p>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
        </div>
@endsection
