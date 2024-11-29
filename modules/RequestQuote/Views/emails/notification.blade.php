@extends('Email::layout')
@section('content')

    <div class="b-container">
        <div class="b-panel">
            <div class="b-panel">
                <div class="b-table-wrap">
                    <table class="b-table" cellspacing="0" cellpadding="5">
                        <tr class="info-first-name">
                            <td class="label">{{__('Name')}}</td>
                            <td class="val">{{$requestquote->name}}</td>
                        </tr>
                        <tr class="info-first-name">
                            <td class="label">{{__('E-mail')}}</td>
                            <td class="val">{{$requestquote->email}}</td>
                        </tr>
                        @if($requestquote->phone)
                            <tr class="info-first-name">
                                <td class="label">{{__('Telefonnummer')}}</td>
                                <td class="val">{{$requestquote->phone}}</td>
                            </tr>
                        @endif
                        @if($requestquote->service)
                            <tr class="info-first-name">
                                <td class="label">{{__('Was können wir für Sie tun?')}}</td>
                                <td class="val">{{$requestquote->service}}</td>
                            </tr>
                        @endif

                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
