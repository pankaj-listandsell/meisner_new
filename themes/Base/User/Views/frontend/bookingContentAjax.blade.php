<div class="booking-d-content">
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Tour')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{ $booking->tour->title }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Tour Date')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{ getDateFormatAsLocale($booking->tour_date) }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Transport')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            {{ $booking->transport->name }}
            @if($booking->transport->type == 'hotel' && is_array($booking->transport_details))
                <div class="well-sm-text mb-3">
                    @if(isset($booking->transport_details['hotel_name']))
                        <div><span class="left-sec">Hotel Name:</span> {{ $booking->transport_details['hotel_name'] }}</div>
                    @endif
                    @if(isset($booking->transport_details['hotel_room_no']))
                        <div><span class="left-sec">Room No:</span> {{ $booking->transport_details['hotel_room_no'] }}</div>
                    @endif
                    @if(isset($booking->transport_details['hotel_phone_no']))
                        <div><span class="left-sec">Phone No:</span> {{ $booking->transport_details['hotel_phone_no'] }}</div>
                    @endif
                    @if(isset($booking->transport_details['hotel_address']) && !empty($booking->transport_details['hotel_address']))
                        <div><span class="left-sec">Address:</span> {!! $booking->transport_details['hotel_address'] !!}</div>
                    @endif
                </div>
            @endif
        </div>

    </div>
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Members')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <span class="mr-4">@lang('Total'): {{ $booking->total_member }}</span>
            @foreach($booking->member_detail as $member)
                @if($member['size'] > 0)
                    <small class="ml-2">
                        @if($member['type'] == 'adult')
                            @lang('Adult')
                        @elseif($member['type'] == 'child')
                            @lang('Children')
                        @else
                            @lang('Infants')
                        @endif
                        ({{ $member['size'] }})
                    </small>
                @endif
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Total Price')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{ $booking->currency }} {{ $booking->discount > 0 ? getPriceFormat($booking->tour_price) : getPriceFormat($booking->total_price) }}</p>
        </div>
    </div>
    @if($booking->discount > 0)
        <div class="row">
            <div class="col-md-4 col-xs-6">
                <label>@lang('Total Discount')</label>
            </div>
            <div class="col-md-6 col-xs-6">
                <p>{{ $booking->currency }} {{ getPriceFormat($booking->discount_price) }}</p>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Total Paid')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{ $booking->currency }} {{ getPriceFormat($booking->deposit) }}
                ({{ getDepositTypeReadable($booking->deposit_type) }})</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>Personal Detail</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <b>Name:</b> {{ $booking->first_name." ".$booking->last_name }} <br/>
            <b>Email:</b> {{ $booking->email }} <br/>
            @if(!empty($booking->phone_no))
                <b>Phone No:</b> {{ $booking->phone_no }} <br/>
            @endif
            @if(!empty($booking->mobile_no))
                <b>Mobile No:</b> {{ $booking->mobile_no }} <br/>
            @endif
            @if(!empty($booking->nationality))
                <b>Nationality:</b> {{ $booking->nationality }} <br/>
            @endif
            <b>Address:</b> {{ $booking->address }} <br/>
            <b>City:</b> {{ $booking->city }} <br/>
            <b>Zip Code:</b> {{ $booking->postal_code }} <br/>
            @if(!empty(getArrayFromString($booking->additional_contacts)))
                <div>
                    <b>Additional contacts:</b>
                    @foreach(getArrayFromString($booking->additional_contacts) as $contact)
                        @if($contact['selected'] == 1)
                            <div>{{ $contact['name'] }}: {{ $contact['contact_no'] }}</div>
                        @endif
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</div>
