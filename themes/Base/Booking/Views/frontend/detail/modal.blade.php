<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#booking-detail-{{$booking->id}}">{{__("Booking Detail")}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#booking-pickup-{{$booking->id}}">
            {{__("Pickup Detail")}}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#booking-customer-{{$booking->id}}">
            @if(Auth::user()->role_name=='Administrator')
                {{__("Customer Information")}}
            @else
                {{__('Personal Information')}}
            @endif
        </a>
    </li>
</ul>
<div class="tab-content">
    <div id="booking-detail-{{$booking->id}}" class="tab-pane active">
        <div class="booking-review">
            <div class="booking-review-content">
                <div class="review-section">
                    <div class="info-form">
                        <ul>
                            <li>
                                <div class="label">{{__('Booking Status')}}</div>
                                <div class="val">{{$booking->statusName}}</div>
                            </li>
                            <li>
                                <div class="label">{{__('Booking Date')}}</div>
                                <div class="val">{{display_date($booking->created_at)}}</div>
                            </li>
                            @if(!empty($booking->gateway))
                                <?php $gateway = get_payment_gateway_obj($booking->gateway);?>
                                @if($gateway)
                                    <li>
                                        <div class="label">{{__('Payment Method')}}</div>
                                        <div class="val">{{$gateway->name}}</div>
                                    </li>
                                @endif
                            @endif

                            <li class="members">
                                <div class="label">{{__('Members')}}</div>
                                    <br/>
                                @foreach($booking->member_detail as $member)
                                    @if($member['size'] > 0)
                                    <div class="member">
                                        <div class="label">{{$member['type']}}:<span class="price-breakdown">  ({{$member['size']}} * {{$member['price']}})</span></div>
                                        <div class="val">{{format_money($member['price'] * $member['size'])}}</div>
                                    </div>
                                    @endif
                                @endforeach
                            </li>

                            <li class="final-total d-block">
                                <div class="d-flex justify-content-between">
                                    <div class="label">{{__("Total:")}}</div>
                                    <div class="val">{{format_money($booking->total_price)}}</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="label">{{__("Paid:")}}</div>
                                    <div class="val">{{format_money($booking->deposit)}}</div>
                                </div>
                                @if($booking->deposit < $booking->total_price )
                                    <div class="d-flex justify-content-between">
                                        <div class="label">{{__("Remain:")}}</div>
                                        <div class="val">{{format_money($booking->total_price - $booking->deposit)}}</div>
                                    </div>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="more-booking-review">
{{--            @include ($service->checkout_booking_detail_file ?? '')--}}
        </div>
    </div>
    <div id="booking-customer-{{$booking->id}}" class="tab-pane fade">
        @include ($service->booking_customer_info_file ?? 'Booking::frontend/booking/booking-customer-info')
    </div>
    <div id="booking-pickup-{{$booking->id}}" class="tab-pane fade">
        <div class="booking-review">
            <div class="booking-review-content">
                <div class="review-section">
                    <div class="info-form">
                        <ul>
                            @php
                                $transport_detail = $booking->transport_details;
                            @endphp

                            @foreach($transports as $transport)
                                @if($transport->id == $booking->transport_id)
                                    <li class="info-pickup-type">
                                        <div class="label">{{__('Pickup Type')}}</div>
                                        <div class="val">{!! clean($transport->name) !!}</div>
                                    </li>

                                    @if($transport->type == 'hotel' )
                                        <div class="info-pickup-details">
                                            <li class="info-pickup-detail">
                                                <div class="label">{{__('Hotel-Name')}}</div>
                                                <div class="val">{!! clean($transport_detail->hotel_name) !!}</div>
                                            </li>
                                            <li class="info-pickup-detail">
                                                <div class="label">{{__('Room-Nummer')}}</div>
                                                <div class="val">{!! clean($transport_detail->hotel_room_no) !!}</div>
                                            </li>
                                            <li class="info-pickup-detail">
                                                <div class="label">{{__('Hotel Phonenumber')}}</div>
                                                <div class="val">{!! clean($transport_detail->hotel_phone_no) !!}</div>
                                            </li>
                                            <li class="info-pickup-detail">
                                                <div class="label">{{__('Hotel Addres')}}</div>
                                                <div class="val">{!! clean($transport_detail->hotel_address) !!}</div>
                                            </li>
                                        </div>
                                    @elseif($transport->type== 'own_pickup')
                                        <div class="info-pickup-details">
                                            <li class="info-pickup-detail">
                                                <div class="label">{{__('Street + No.')}}</div>
                                                <div class="val">{!! clean($transport_detail->street_no) !!}</div>
                                            </li>
                                            <li class="info-pickup-detail">
                                                <div class="label">{{__('City')}}</div>
                                                <div class="val">{!! clean($transport_detail->city) !!}</div>
                                            </li>
                                            <li class="info-pickup-detail">
                                                <div class="label">{{__('Zip Code')}}</div>
                                                <div class="val">{!! clean($transport_detail->postal_code) !!}</div>
                                            </li>
                                        </div>
                                    @endif
                                @endif

                            @endforeach

{{--                            <div>{{$booking->transport_details}}</div>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
