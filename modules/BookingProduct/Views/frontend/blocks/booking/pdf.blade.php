<!DOCTYPE html>
<html>
<head>
    <title>Booking Invoice</title>
</head>
<body>
    <h1>Invoice</h1>
    <p>Booking ID: {{ $row->booking_id }}</p>
    <p>Customer Name: {{ $row->full_name }}</p>
    <p>Email: {{ $row->email }}</p>
    <p>Summary:</p>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>QTY</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detail as $item)
                <tr>
                    <td>{{ $item->product_title }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->total_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p><strong>Stücke insgesamt:</strong>{{$row->total_pieces}} </p>
    <p><strong>Nettobetrag:</strong>{{priceConvert($row->net_amount)}} €</p>
    <p><strong>Vat : ({{$row->vat_percent}} %) </strong> {{priceConvert($row->vat)}} €</p>
    <p><strong>Insgesamt:</strong>{{priceConvert($row->grand_amount)}} €</p>


</body>
</html>
