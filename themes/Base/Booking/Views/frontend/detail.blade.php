@extends('layouts.app')
@push('css')
    <link href="{{ asset('module/booking/css/checkout.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
@endpush
@section('content')
    <div class="bravo-booking-page padding-content" >
        <div class="container">
            <div class="row booking-success-notice">
                <div class="col-lg-8 col-md-8">
                    <div class="d-flex align-items-center">
                        <img src="{{url('images/ico_success.svg')}}" alt="Payment Success">
                        <div class="notice-success">
                            <p class="line1"><span>{{$booking->first_name}},</span>
                                {{__('your order was submitted successfully!')}}
                            </p>
                            <p class="line2">{{__('Booking details has been sent to:')}} <span>{{$booking->email}}</span></p>
                            @if($note = $gateway->getOption("payment_note"))
                                <div class="line2">{!! clean($note) !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <ul class="booking-info-detail">
                        <li><span>{{__('Booking Number')}}:</span> {{$booking->id}}</li>
                        <li><span>{{__('Booking Date')}}:</span> {{display_date($booking->created_at)}}</li>
                        @if(!empty($gateway))
                        <li><span>{{__('Payment Method')}}:</span> {{$gateway->name}}</li>
                        @endif
                        <li><span>{{__('Booking Status')}}:</span> {{ $booking->status_name }}</li>
                    </ul>
                </div>
            </div>
            <div class="row booking-success-detail">
                <div class="col-md-8">
                    @include ($service->booking_customer_info_file ?? 'Booking::frontend/booking/booking-customer-info')
                    @include ('Booking::frontend.detail.passengers')
                    <div class="text-center">
                        <a href="{{route('user.booking_history')}}" class="btn btn-primary">{{__('Booking History')}}</a>
                    </div>
                </div>
                <div class="col-md-4">
                    @include ($service->checkout_booking_detail_file ?? '')
                </div>
            </div>
        </div>
    </div>
@endsection
