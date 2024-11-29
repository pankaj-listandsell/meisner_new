<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{$html_class ?? ''}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="rE7dtCgRrkax4PM3voLeDf5GpGX3ZwlTGZ9WNPY807s" />
    <link rel="stylesheet" href="{{ asset('assests/css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('assests/css/service.css') }}">
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

    <link rel='stylesheet' href="{{ asset('assests/css/slick.min.css') }}">
    <link rel='stylesheet' href="{{ asset('assests/css/slick.min.css') }}">
    <link rel='stylesheet' href="{{ asset('assests/css/slick-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assests/css/toastr.min.css') }}">
    <link href="{{ asset('vendor/cookie-consent/css/cookie-consent.css')}}" rel="stylesheet">        
    @php
    $row_id = 0;
        if (!empty($row->id)) {
            $row_id = $row->id;
        }
    @endphp

    @if($row_id != 116)
        <link rel="stylesheet" href="{{ asset('assests/css/other-page.css') }}">
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
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-CE5K549911"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-CE5K549911');
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KCMDMSP9');</script>
<!-- End Google Tag Manager -->
</head>
<?php
$row_id = 0;
if (!empty($row->id)) {
    $row_id = $row->id;
}
?>
<body class="page-id-{{ $row_id }}">
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KCMDMSP9"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    @if(!is_api())
        @include('Layout::parts.topbar')
        @include('Layout::parts.header')
    @endif

    @yield('content')
</div>

@include('Layout::parts.footer')
<script src="{{ asset('assests/js/jquery.min.js') }}"></script>
<script src="{{ asset('assests/js/slick.min.js') }}" defer></script>
<script src="{{ asset('assests/js/script.js') }}" defer></script>
<script src="{{ asset('assests/js/toastr.min.js') }}"></script>
@stack('js')
<script>

    $(document).ready(function(){

        $('.popup-contact-form [type=submit]').click(function (e) {

            e.preventDefault();
            let form = $(this).closest('.popup-form-elements');

            $.ajax({
                url: '{{ route('frontend.register.popup_contact') }}',
                data: {
                    'name': form.find('input[name=name]').val(),
                    'email': form.find('input[name=email]').val(),
                    'phone_no': form.find('input[name=phone_no]').val(),
                    'captcha': form.find('[name=captcha]').val(),
                    'terms': form.find('input[name=terms]').is(":checked") ? 1 : '',
                },
                method: 'POST',
                beforeSend: function () {
                    form.find('.alert-error').hide();
                    //form.find('.icon-loading').css("display", 'inline-block');
                },
                dataType: 'json',
                success: function (data) {
                    //form.find('.icon-loading').hide();
                    if (data.error === true) {
                        if (data.messages !== undefined) {
                            var errorHtml = "<ul>";
                            for (var item in data.messages) {
                                errorHtml += '<li>'+data.messages[item]+'</li>';
                            }
                            errorHtml += "</ul>";
                            form.find('.message-alert').show().html(errorHtml);
                        }
                        return;
                    }
                    if (data.message) {
                        form.find('.message-alert').show().html('<div class="alert alert-success">' + data.message + '</div>');
                        form.find('input').val('');
                        form.find('input[type=checkbox]').prop('checked', false);
                        form.find('.captcha-img').html(data.data);
                    }
                },
                error: function (e) {
                    form.find('.icon-loading').hide();

                    if (typeof e.responseJSON !== 'undefined') {
                        var html = ajax_error_to_string(e);
                        if (html) {
                            form.find('.message-alert').show().html('<div class="alert alert-danger">' + html + '</div>');
                        }
                        if (e.responseJSON.captcha_img) {
                            form.find('.captcha-img').html(e.responseJSON.captcha_img);
                        }
                    }

                }
            });
        })
    });
    function ajax_error_to_string(e) {
        if (typeof e.responseJSON !== 'undefined') {
            if (e.responseJSON.errors) {
                var html = [];
                for (var k in e.responseJSON.errors) {
                    html.push(e.responseJSON.errors[k].join("<br/>"));
                }

                return html.join("<br/>");
            }

            if (e.responseJSON.message) {
                return e.responseJSON.message;
            }
        }
    }

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    //Login
    function ajax_error_to_string(e) {
        if (typeof e.responseJSON !== 'undefined') {
            if (e.responseJSON.errors) {
                var html = [];
                for (var k in e.responseJSON.errors) {
                    html.push(e.responseJSON.errors[k].join("<br/>"));
                }

                return html.join("<br/>");
            }

            if (e.responseJSON.message) {
                return e.responseJSON.message;
            }
        }
    }
    $('.bravo-form-login [type=submit]').click(function (e) {
       e.preventDefault();
       let form = $(this).closest('.bravo-form-login');
       var redirect = form.find('input[name=redirect]').val();

       $.ajax({
           url: bookingCore.url + '/login',
           data: {
               'email': form.find('input[name=email]').val(),
               'password': form.find('input[name=password]').val(),
               'remember': form.find('input[name=remember]').is(":checked") ? 1 : '',
               'g-recaptcha-response': form.find('[name=g-recaptcha-response]').val(),
               'redirect': form.find('input[name=redirect]').val()
           },
           method: 'POST',
           beforeSend: function () {
               form.find('.error').hide();
               form.find('.icon-loading').css("display", 'inline-block');
           },
           dataType: 'json',
           success: function (data) {
               if (data.two_factor) {
                   return window.location.href = bookingCore.url + '/two-factor-challenge';
               }
               form.find('.icon-loading').hide();
               if (data.error === true) {
                   if (data.messages !== undefined) {
                       for (var item in data.messages) {
                           var msg = data.messages[item];
                           form.find('.error-' + item).show().text(msg[0]);
                       }
                   }
                   if (data.messages.message_error !== undefined) {
                       form.find('.message-error').show().html('<div class="alert alert-danger">' + data.messages.message_error[0] + '</div>');
                   }
                   return;
               }
               if (data.message) {
                   form.find('.message-error').show().html('<div class="alert alert-success">' + data.message + '</div>');
               }
               if (typeof BravoReCaptcha !== 'undefined') {
                   BravoReCaptcha.reset('login');
                   BravoReCaptcha.reset('login_normal');

               }
               if (redirect.trim('/')) {
                   window.location.href = bookingCore.url_root + form.find('input[name=redirect]').val();
               } else {
                   window.location.reload();
               }

           },
           error: function (e) {
               form.find('.icon-loading').hide();
               var html = ajax_error_to_string(e);
               if (typeof BravoReCaptcha !== 'undefined') {
                   BravoReCaptcha.reset('login');
                   BravoReCaptcha.reset('login_normal');

               }
               if (html) {
                   form.find('.message-error').show().html('<div class="alert alert-danger">' + html + '</div>');
               }
           }
       });
   })
</script>
</body>
</html>
