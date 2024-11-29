@extends('Email::layout')
@section('content')

    <div class="b-container">
        <div class="b-panel">
            <div class="b-panel">
                <div class="b-table-wrap">
                    <table class="b-table" cellspacing="0" cellpadding="5">
                        <tr class="info-first-name">
                            <td class="label">{{__('Name')}}</td>
                            <td class="val">{{$contact->first_name.' '.$contact->last_name}}</td>
                        </tr>
                        <tr class="info-first-name">
                            <td class="label">{{__('E-mail')}}</td>
                            <td class="val">{{$contact->email}}</td>
                        </tr>
                        @if($contact->phone)
                            <tr class="info-first-name">
                                <td class="label">{{__('Telefonnummer')}}</td>
                                <td class="val">{{$contact->phone}}</td>
                            </tr>
                        @endif
                        @if($contact->nationality)
                            <tr class="info-first-name">
                                <td class="label">{{__('Nationality')}}</td>
                                <td class="val">{{$contact->nationality}}</td>
                            </tr>
                        @endif
                        @if($contact->subject)
                            <tr class="info-first-name">
                                <td class="label">{{__('Subject')}}</td>
                                <td class="val">{{$contact->subject}}</td>
                            </tr>
                        @endif
                        <tr class="info-first-name">
                            <td class="label">{{__('Nachricht')}}</td>
                            <td class="val">{{$contact->message}}</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
