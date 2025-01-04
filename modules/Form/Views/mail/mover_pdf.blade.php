<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @font-face {
            font-family: 'Open Sans';
            src: url({{ storage_path("fonts/OpenSans/OpenSans-Bold.ttf") }}) format("truetype");
            font-weight: 700;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url({{ storage_path("fonts/OpenSans/OpenSans-BoldItalic.ttf") }}) format("truetype");
            font-weight: 700;
            font-style: italic;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url({{ storage_path("fonts/OpenSans/OpenSans-ExtraBold.ttf") }}) format("truetype");
            font-weight: 800;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url({{ storage_path("fonts/OpenSans/OpenSans-ExtraBoldItalic.ttf") }}) format("truetype");
            font-weight: 800;
            font-style: italic;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url({{ storage_path("fonts/OpenSans/OpenSans-Light.ttf") }}) format("truetype");
            font-weight: 300;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url({{ storage_path("fonts/OpenSans/OpenSans-LightItalic.ttf") }}) format("truetype");
            font-weight: 300;
            font-style: italic;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url({{ storage_path("fonts/OpenSans/OpenSans-Medium.ttf") }}) format("truetype");
            font-weight: 500;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url({{ storage_path("fonts/OpenSans/OpenSans-MediumItalic.ttf") }}) format("truetype");
            font-weight: 500;
            font-style: italic;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url({{ storage_path("fonts/OpenSans/OpenSans-Regular.ttf") }}) format("truetype");
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url({{ storage_path("fonts/OpenSans/OpenSans-SemiBold.ttf") }}) format("truetype");
            font-weight: 600;
            font-style: normal;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url({{ storage_path("fonts/OpenSans/OpenSans-SemiBoldItalic.ttf") }}) format("truetype");
            font-weight: 600;
            font-style: italic;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url({{ storage_path("fonts/OpenSans/OpenSans-Italic.ttf") }}) format("truetype");
            font-weight: 400;
            font-style: italic;
        }

        * {
            font-family: "Open Sans", Arial, 'Helvetica Neue', Helvetica, sans-serif;
        }

        .header {
            text-align: right;
        }

        .group-name {
            color: #000;
            font-size: 18px;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 7px;
        }

        .img-unloading, .img-offloading {
            height: 45px;
        }

        table.header {
            width: 100%;
        }

        td.img-table-col figure {
            text-align: left;
            margin: 10px 2px 10px 2px;
        }

        table.header {
            border-bottom: 1px solid #ff6560;
        }

        td {
            width: 50%;
            font-size: 16px;
            vertical-align: top;
        }

        table.client-detail {
            width: 100%;
        }

        table {
            width: 100%;
        }

        .header-bar.totalmeter {
            text-align: right;
        }

        .header-bar {
            background: #CFDE29;
            padding: 4px 7px;
            font-size: 16px;
            text-align: center;
            margin-bottom: 0;
            margin-top: 0;

        }

        td p {
            margin-bottom: 0;
            margin-top: 3px;
        }

        .group-furn-list {

            padding-bottom: 2px;
        }

        h3.client-moving-title {
            margin-top: 5px;
            margin-bottom: 6px;
        }

        .fromtotxt {
            font-size: 18px;
        }
        .datebar{
            font-size: 18px;
        }
        .datebar {
    font-size: 15px;
    text-align: left;
}
table.location-detail-title tr td.timetd {
    width: 70%;
}
.totalmeter{
    font-size: 15px;
}
    </style>
</head>
<body>
    <table class="header">
        <tr>
            <td class="img-table-col">
                <figure>
                @php
                      $logo_id = setting_item("logo_id");
                      if(!empty($row->custom_logo)){
                          $logo_id = $row->custom_logo;
                      }
                  @endphp
                  @if($logo_id)
                      <?php $logo = get_file_url($logo_id,'full') ?>
 							<img src="{{$logo}}"
                         alt="logo"/ width="170px" height="auto">
                  @endif
                </figure>
            </td>
            <td>
                <div class="header-detail">
                    <strong> @lang('Meissner Entrümpelung')</strong>
                    <br/>
                    Oranienburgerstr. 47
                    <br/>
                    13437 Berlin
                    <br/>
                    @lang('Telephone'): 030 4172 3130
                </div>
            </td>
        </tr>
    </table>
    <h3 class="client-moving-title">Auftraggeber- und Umzugsdaten:</h3>
    <table class="client-detail">
        <tr>
            <td>{{ $data['reach_title'] }}  {{ $data['reach_name'] }}</td>
            <td>
                <strong> @lang('Email'):</strong> {{ $data['reach_email'] }}
                <br/>
                <strong>@lang('Mobile'):</strong> {{ $data['reach_telephone'] }}
            </td>
        </tr>
    </table>
    <table class="location-detail">
        <tr>
            <td>
                <div class="header-bar datebar">
                    <strong> @lang('Flexible period')</strong>
                    {{ isset($data['moving_date_from']) ? date('d.m.Y', strtotime($data['moving_date_from'])) : "" }}
                    {{ isset($data['moving_date_to']) && $data['moving_date_to'] != '' ? ' - '.date('d.m.Y', strtotime($data['moving_date_to'])) : '' }}
                </div>
                <figure>
                    <img class="img-unloading"
                         src="{{ isset($testing) ? asset('dist/frontend/images/unloading.png') : public_path('dist/frontend/images/unloading.png') }}"
                         alt="unloading"/>
                </figure>
                <div>
                    <p class="fromtotxt"><strong> {{ trans('From') }}:</strong></p>
                    {{ $data['from_street'] }} <br/>
                    {{ $data['from_postal_code'] }}, {{ $data['from_city'] }} <br/>
                    {{ $data['from_country'] }}
                </div>
            </td>
            <td>
                <div class="header-bar totalmeter">
                    <strong> @lang('Goods to be moved'):</strong> {{ $data['total_moving_object'] ?? '' }} <span
                            class="metercube">m³</span>
                </div>
                <figure>
                    <img class="img-offloading"
                         src="{{ isset($testing) ? asset('dist/frontend/images/offloading.png') : public_path('dist/frontend/images/offloading.png') }}"
                         alt="offloading"/>
                </figure>
                <div>
                    <p class="fromtotxt"><strong>{{ trans('To') }}:</strong></p>
                    {{ $data['to_street'] }} <br/>
                    {{ $data['to_postal_code'] }}, {{ $data['to_city'] }} <br/>
                    {{ $data['to_country'] }}
                </div>
            </td>
        </tr>
    </table>
    <table class="moving-detail">
        <tr>
            <td colspan="2">
                <div class="header-bar"><strong>@lang('Moving detail')</strong></div>
            </td>
        </tr>
        <p class="priv"><strong>@lang('Select your type of move'):</strong> {{ $data['mover_type'] }}</p>
        <tr>

            <td>
                <p class="fromtotxt"><strong>@lang('From')</strong></p>
                <p>@lang('Living space'): {{ $data['from_living_space'] }}</p>
                <p>@lang('I live in a'): {{ $data['from_lives_in'] }}</p>
                <p>@lang('Person'): {{ $data['from_total_persons'] }}</p>
                <p>@lang('Floor'): {{ $data['from_floor'] }}</p>
                <p>@lang('Room'): {{ $data['from_total_rooms'] }}</p>
                <p>@lang('Kitchen disassemble'): {{ $data['from_kitchen_disassemble'] ? trans('Yes') : trans('No') }}</p>
                <p>@lang('Furniture disassemble')
                    : {{ $data['from_furniture_disassemble'] ? trans('Yes') : trans('No') }}</p>
                <p>@lang('No parking zone'): {{ $data['from_no_stopping'] }}</p>
                <p>@lang('Who will cover the costs?'): {{ $data['reach_cost'] }}</p>
            </td>
            <td>
                <p class="fromtotxt"><strong>@lang('To')</strong></p>
                <p>@lang("I'm moving into an"): {{ $data['to_move_to'] }}</p>
                <p>@lang('Floor'): {{ $data['from_floor'] }}</p>
                <p>@lang('Elevator available'): {{ $data['to_has_elevator'] ? trans('Yes') : trans('No') }}</p>
                <p>Möbel montieren: {{ $data['to_furniture_assemble'] ? trans('Yes') : trans('No') }}</p>
                <p>@lang('Unpacking boxes'): {{ $data['to_unpack_boxes'] }}</p>
                <p>@lang('No parking zone'): {{ $data['to_no_stopping'] }}</p>
            </td>
        </tr>
    </table>
    <table class="moving-detail">
        <tr>
            <td colspan="2">
                <div class="header-bar"><strong>@lang('Moving details')</strong></div>
            </td>
        </tr>
        <tr>
            <td>
                <p>@lang('Carrying distance'): {{ $data['from_carrying_distance'] }}</p>
                <p>@lang('Staircase'): {{ $data['from_staircase'] }}</p>
                <p>@lang('House position'): {{ $data['from_house_position'] }}</p>
                <p>Notiz: {{ $data['from_loading_note'] }}</p>
            </td>
            <td>
                <p>@lang('Carrying distance'): {{ $data['to_carrying_distance'] }}</p>
                <p>@lang('Staircase'): {{ $data['to_staircase'] }}</p>
                <p>@lang('House position'): {{ $data['to_house_position'] }}</p>
                <p>Notiz: {{ $data['to_loading_note'] }}</p>
            </td>
        </tr>
    </table>
    <div class="packing-list">
        <div class="header-bar"><strong>@lang('Furniture and packing list')</strong></div>
        @foreach($groups as $name => $group)
            <div class="group-name">{{ $name }}</div>
            @foreach($group as $row)
                <div class="group-furn-list"><span class="furniture-value"> {{ $row->value }} * {{ \App\Libraries\FormSchema\Form\MoverForm::getUnitByKey($row->key) }} m<sup>3</sup> - </span>
                    <span class="furniture-label"> {{ $row->label }}</span></div>

            @endforeach
        @endforeach

    </div>
</body>
</html>

