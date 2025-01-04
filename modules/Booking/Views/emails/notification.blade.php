@extends('Email::layout')
@section('content')

    <div class="b-container">
        <div class="b-panel">
            <div class="b-panel">
                <div class="b-table-wrap">
                    <table class="b-table" cellspacing="0" cellpadding="5">
                        <tr class="info-first-name">
                            <td class="label">{{__('Haben Sie bereits einen Wunschtermin?')}}</td>
                            <td class="val">{{$booking->has_preferred_date}}</td>
                        </tr>
                        <tr class="info-first-name">
                            <td class="label">{{__('Wunschtermin')}}</td>
                            <td class="val">{{$booking->preferred_date}}</td>
                        </tr>
                        @if($booking->preferred_time)
                            <tr class="info-first-name">
                                <td class="label">{{__('Uhrzeit')}}</td>
                                <td class="val">{{$booking->preferred_time}}</td>
                            </tr>
                        @endif
                        @if($booking->service)
                            <tr class="info-first-name">
                                <td class="label">{{__('Service')}}</td>
                                <td class="val">{{ implode(', ',json_decode($booking->service)) }}</td>
                            </tr>
                        @endif
                        @if($booking->order_street)
                            <tr class="info-first-name">
                                <td class="label">{{__('Straße und Hausnummer')}}</td>
                                <td class="val">{{$booking->order_street}}</td>
                            </tr>
                        @endif
                        @if($booking->order_postal_code)
                        <tr class="info-first-name">
                            <td class="label">{{__('PLZ')}}</td>
                            <td class="val">{{$booking->order_postal_code}}</td>
                        </tr>
                        @endif
                        @if($booking->order_city)
                        <tr class="info-first-name">
                            <td class="label">{{__('Ort')}}</td>
                            <td class="val">{{$booking->order_city}}</td>
                        </tr>
                        @endif
                        @if($booking->order_country)
                        <tr class="info-first-name">
                            <td class="label">{{__('Land')}}</td>
                            <td class="val">{{$booking->order_country}}</td>
                        </tr>
                        @endif
                        @if($booking->order_living_space)
                        <tr class="info-first-name">
                            <td class="label">{{__('Wohnfläche (m²)')}}</td>
                            <td class="val">{{$booking->order_living_space}}</td>
                        </tr>
                        @endif
                        @if($booking->order_total_rooms)
                        <tr class="info-first-name">
                            <td class="label">{{__('Anzahl der Räume')}}</td>
                            <td class="val">{{$booking->order_total_rooms}}</td>
                        </tr>
                        @endif
                        @if($booking->order_evacuation_site)
                        <tr class="info-first-name">
                            <td class="label">{{__('Evakuierungsstelle')}}</td>
                            <td class="val">{{$booking->order_evacuation_site}}</td>
                        </tr>
                        @endif
                        @if($booking->order_has_basement)
                        <tr class="info-first-name">
                            <td class="label">{{__('Has basement')}}</td>
                            <td class="val">{{$booking->order_has_basement}}</td>
                        </tr>
                        @endif
                        @if($booking->order_has_more_storage)
                        <tr class="info-first-name">
                            <td class="label">{{__('Hat Keller')}}</td>
                            <td class="val">{{$booking->order_has_more_storage}}</td>
                        </tr>
                        @endif
                        @if($booking->order_floor)
                        <tr class="info-first-name">
                            <td class="label">{{__('Stockwerk')}}</td>
                            <td class="val">{{$booking->order_floor}}</td>
                        </tr>
                        @endif
                        @if($booking->order_has_elevator)
                        <tr class="info-first-name">
                            <td class="label">{{__('Hat einen Aufzug')}}</td>
                            <td class="val">{{$booking->order_has_elevator}}</td>
                        </tr>
                        @endif
                        @if($booking->order_stopping_ban)
                        <tr class="info-first-name">
                            <td class="label">{{__('Halteverbot')}}</td>
                            <td class="val">{{$booking->order_stopping_ban}}</td>
                        </tr>
                        @endif
                        @if($booking->contact_first_name)
                        <tr class="info-first-name">
                            <td class="label">{{__('Vorname')}}</td>
                            <td class="val">{{$booking->contact_first_name}}</td>
                        </tr>
                        @endif
                        @if($booking->contact_last_name)
                        <tr class="info-first-name">
                            <td class="label">{{__('Nachname')}}</td>
                            <td class="val">{{$booking->contact_last_name}}</td>
                        </tr>
                        @endif
                        @if($booking->contact_company)
                        <tr class="info-first-name">
                            <td class="label">{{__('Firma')}}</td>
                            <td class="val">{{$booking->contact_company}}</td>
                        </tr>
                        @endif
                        @if($booking->contact_telephone_no)
                        <tr class="info-first-name">
                            <td class="label">{{__('Telefonnummer')}}</td>
                            <td class="val">{{$booking->contact_telephone_no}}</td>
                        </tr>
                        @endif
                        @if($booking->contact_email)
                        <tr class="info-first-name">
                            <td class="label">{{__('Email')}}</td>
                            <td class="val">{{$booking->contact_email}}</td>
                        </tr>
                        @endif
                        @if($booking->work_detail)
                        <tr class="info-first-name">
                            <td class="label">{{__('Arbeitsdetail')}}</td>
                            <td class="val">{{$booking->work_detail}}</td>
                        </tr>
                        @endif
                        @if($booking->extra_service)
                        <tr class="info-first-name">
                            <td class="label">{{__('Extra service')}}</td>
                            <td class="val">{{ implode(', ',json_decode($booking->extra_service)) }}</td>
                        </tr>
                        @endif

                       {{-- @if($booking->attachment)
                        <tr class="info-first-name">
                            <td class="label">{{__('Attachment')}}</td>
                            <td class="val"><a href="{{ asset('storage/' . $booking->attachment) }}" target="_blank">@lang('View File')</a></td>
                        </tr>
                        @endif --}}
                        {{-- // pankaj change --}}
                        @if($booking->attachment)
                        <tr class="info-first-name">
                            <td class="label">{{__('Attachments')}}</td>
                            <td class="val">
                                @php
                                    // Decode the JSON string into an array
                                    $attachments = json_decode($booking->attachment, true);
                                @endphp
                                @if(is_array($attachments))
                                    @foreach($attachments as $attachment)
                                        <a href="{{ asset('storage/' . $attachment) }}" target="_blank">@lang('View File')</a><br>
                                    @endforeach
                                @else
                                    <a href="{{ asset('storage/' . $booking->attachment) }}" target="_blank">@lang('View File')</a>
                                @endif
                            </td>
                        </tr>
                    @endif

                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
