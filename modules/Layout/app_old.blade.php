<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{$html_class ?? ''}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php event(new \Modules\Layout\Events\LayoutBeginHead()); @endphp
    @php
        $favicon = setting_item('site_favicon');
    @endphp
    @if($favicon)
        @php
            $file = (new \Modules\Media\Models\MediaFile())->findById($favicon);
        @endphp
        @if(!empty($file))
            <link rel="icon" type="{{$file['file_type']}}" href="{{asset('uploads/'.$file['file_path'])}}"/>
        @else
            <link rel="icon" type="image/png" href="{{url('images/favicon.png')}}"/>
        @endif
    @endif

    @include('Layout::parts.seo-meta')

    @if(!isOnProduction())
    <link href="{{ asset('css/fontello.css') }}" media="print" onload="this.media='all'"
          rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" media="print" onload="this.media='all'"
          rel="stylesheet">
    <link href='{{ asset('css/font-poppins.css') }}' rel='stylesheet' media="print" onload="this.media='all'"/>
    <link href="{{ asset('css/frontend-app.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">

    <!-- Custom Css -->
    <link href="{{ asset('vendor/cookie-consent/css/cookie-consent.css')}}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend-custom.css') }}" rel="stylesheet">
    @else
    <!-- <link rel="stylesheet" href="{{ asset('css/combined-app.css?version='.rand(1,10000)) }}"/> -->
    @endif


    @stack('css')

    <script>
        var bookingCore = {
            url: '{{url('/')}}',
            url_root: '{{ url('/') }}',
            admin_url: '{{ route('admin.index') }}',
            booking_decimals: {{(int)get_current_currency('currency_no_decimal',2)}},
            thousand_separator: '{{get_current_currency('currency_thousand')}}',
            decimal_separator: '{{get_current_currency('currency_decimal')}}',
            currency_position: '{{get_current_currency('currency_format')}}',
            currency_symbol: '{{currency_symbol()}}',
            currency_rate: '{{get_current_currency('rate',1)}}',
            date_format: '{{get_moment_date_format()}}',
            map_provider: '{{setting_item('map_provider')}}',
            map_gmap_key: '{{setting_item('map_gmap_key')}}',
            map_options: {
                map_lat_default: '{{setting_item('map_lat_default')}}',
                map_lng_default: '{{setting_item('map_lng_default')}}',
                map_clustering: '{{setting_item('map_clustering')}}',
                map_fit_bounds: '{{setting_item('map_fit_bounds')}}',
            },
            routes: {
                login: '{{route('login')}}',
                register: '{{route('auth.register')}}',
            },
            module: {},
            currentUser: {{(int)Auth::id()}},
            isAdmin: {{is_admin() ? 1 : 0}},
            rtl: {{ setting_item_with_lang('enable_rtl') ? "1" : "0" }},
            markAsRead: '{{route('core.notification.markAsRead')}}',
            markAllAsRead: '{{route('core.notification.markAllAsRead')}}',
            loadNotify: '{{route('core.notification.loadNotify')}}',
            pusher_api_key: '{{setting_item("pusher_api_key")}}',
            pusher_cluster: '{{setting_item("pusher_cluster")}}',
            language: '{{ app()->getLocale() }}',
            scrollText: '{{ __('Top') }}'
        };
        @if(auth()->user())
            bookingCore.media = {
            groups: {!! json_encode(config('bc.media.groups')) !!},
        }
        @endif
        var i18n = {
            warning: "{{__("Warning")}}",
            success: "{{__("Success")}}",
        };
        var daterangepickerLocale = {
            "applyLabel": "{{__('Apply')}}",
            "cancelLabel": "{{__('Cancel')}}",
            "fromLabel": "{{__('From')}}",
            "toLabel": "{{__('To')}}",
            "customRangeLabel": "{{__('Custom')}}",
            "weekLabel": "{{__('W')}}",
            "first_day_of_week": {{ setting_item("site_first_day_of_the_weekin_calendar","1") }},
            "daysOfWeek": [
                "{{__('Su')}}",
                "{{__('Mo')}}",
                "{{__('Tu')}}",
                "{{__('We')}}",
                "{{__('Th')}}",
                "{{__('Fr')}}",
                "{{__('Sa')}}"
            ],
            "monthNames": [
                "{{__('January')}}",
                "{{__('February')}}",
                "{{__('March')}}",
                "{{__('April')}}",
                "{{__('May')}}",
                "{{__('June')}}",
                "{{__('July')}}",
                "{{__('August')}}",
                "{{__('September')}}",
                "{{__('October')}}",
                "{{__('November')}}",
                "{{__('December')}}"
            ],
        };
    </script>
    <link rel="stylesheet" href="{{ asset('css/combined-app.css?version='.rand(1,10000)) }}"/>
    <link href="{{ asset('css/huzaifa-custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend-custom.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/cookie-consent/css/cookie-consent.css')}}" rel="stylesheet">
</head>
<body class="frontend-page {{ !empty($row->header_style) ? "header-".$row->header_style : "header-normal" }} {{$body_class ?? ''}} @if(setting_item_with_lang('enable_rtl')) is-rtl @endif @if(is_api()) is_api @endif">

<div class="bravo_wrap">
    @if(!is_api())
        @include('Layout::parts.topbar')
        @include('Layout::parts.header')
    @endif

    @yield('content')
</div>

@include('Layout::parts.footer')
</body>
</html>
