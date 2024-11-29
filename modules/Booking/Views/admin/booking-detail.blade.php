<div class="booking-d-content">
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Name')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{ $booking->fullName }}</p>
        </div>
    </div>

    @if($booking->has_preferred_date)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Has Preferred Date')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{ $booking->has_preferred_date }}</p>
        </div>
    </div>
    @endif

    @if($booking->preferred_date)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Desired Date')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{ $booking->preferred_date }}</p>
        </div>
    </div>
    @endif

    @if($booking->service)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Service')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{ implode(', ',json_decode($booking->service)) }}</p>
        </div>
    </div>
    @endif

    @if($booking->order_street)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Street and House Number')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->order_street}}</p>
        </div>
    </div>
    @endif

    @if($booking->order_postal_code)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Postcode')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->order_postal_code}}</p>
        </div>
    </div>
    @endif

    @if($booking->order_city)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('City')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->order_city}}</p>
        </div>
    </div>
    @endif

    @if($booking->order_country)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Country')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->order_country}}</p>
        </div>
    </div>
    @endif

    @if($booking->order_living_space)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Living space (m²)')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->order_living_space}}</p>
        </div>
    </div>
    @endif

    @if($booking->order_total_rooms)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Number of rooms')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->order_total_rooms}}</p>
        </div>
    </div>
    @endif

    @if($booking->order_evacuation_site)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Evacuation site')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->order_evacuation_site}}</p>
        </div>
    </div>
    @endif

    @if($booking->order_has_basement)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Has basement')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->order_has_basement}}</p>
        </div>
    </div>
    @endif

    @if($booking->order_has_more_storage)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Has more storage')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->order_has_more_storage}}</p>
        </div>
    </div>
    @endif

    @if($booking->order_floor)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Floor')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->order_floor}}</p>
        </div>
    </div>
    @endif

    @if($booking->order_has_elevator)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Has elevator')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->order_has_elevator}}</p>
        </div>
    </div>
    @endif

    @if($booking->order_stopping_ban)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Stopping ban')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->order_stopping_ban}}</p>
        </div>
    </div>
    @endif


    @if($booking->contact_first_name)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('First name')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->contact_first_name}}</p>
        </div>
    </div>
    @endif

    @if($booking->contact_last_name)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Last name')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->contact_last_name}}</p>
        </div>
    </div>
    @endif

    @if($booking->contact_company)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Company')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->contact_company}}</p>
        </div>
    </div>
    @endif

    @if($booking->contact_telephone_no)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Telephone no')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->contact_telephone_no}}</p>
        </div>
    </div>
    @endif

    @if($booking->contact_email)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Email')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->contact_email}}</p>
        </div>
    </div>
    @endif

    @if($booking->work_detail)
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Work detail')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{$booking->work_detail}}</p>
        </div>
    </div>
    @endif

  

    {{-- // pankaj change --}}
    @if($booking->attachment)
        <div class="row">
            <div class="col-md-4 col-xs-6">
                <label>@lang('Attachments')</label>
            </div>
            <div class="col-md-6 col-xs-6">
                @php
                    // Decode the JSON string into an array
                    $attachments = json_decode($booking->attachment, true);
                @endphp
                @if(is_array($attachments))
                    @foreach($attachments as $attachment)
                        <p><a href="{{ asset('storage/' . $attachment) }}" target="_blank">@lang('View File')</a></p>
                    @endforeach
                @else
                    <p><a href="{{ asset('storage/' . $booking->attachment) }}" target="_blank">@lang('View File')</a></p>
                @endif
            </div>
        </div>
    @endif

</div>
