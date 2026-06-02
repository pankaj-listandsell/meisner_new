<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{$html_class ?? ''}}">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="rE7dtCgRrkax4PM3voLeDf5GpGX3ZwlTGZ9WNPY807s" />
    {{-- Preconnect only to origins used early (analytics/GTM). --}}
    <link rel="preconnect" href="https://www.googletagmanager.com" crossorigin>
    <link rel="preconnect" href="https://www.google-analytics.com" crossorigin>
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    <link rel="dns-prefetch" href="https://www.google-analytics.com">
    {{-- reCAPTCHA is lazy-loaded on interaction, so use cheaper dns-prefetch instead of preconnect for its origins. --}}
    <link rel="dns-prefetch" href="https://www.google.com">
    <link rel="dns-prefetch" href="https://www.gstatic.com">
    {{-- Preload only the two above-the-fold web fonts (banner <h1> = Montserrat 700, body = Open Sans
         regular). crossorigin is required even same-origin, or the preload won't match the font request.
         The LCP image keeps priority via its own fetchpriority="high" preload. --}}
    <link rel="preload" as="font" type="font/woff2" href="{{ asset('assests/fonts/montserrat-v26-latin-700.woff2') }}" crossorigin>
    <link rel="preload" as="font" type="font/woff2" href="{{ asset('assests/fonts/open-sans-v40-latin-regular.woff2') }}" crossorigin>
    {{-- Critical site-wide CSS is inlined (with ../ rewritten to /assests/) so it no longer
         blocks render with separate network requests. Both files are above-the-fold/critical. --}}
    <style id="inline-general-css">{!! inline_css_asset('general.css') !!}</style>
    <style id="inline-service-css">{!! inline_css_asset('service.css') !!}</style>
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

    {{-- Non-critical CSS: load async to avoid render-blocking --}}
    <link rel="preload" as="style" href="{{ asset('assests/css/slick.min.css') }}" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" as="style" href="{{ asset('assests/css/slick-theme.min.css') }}" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" as="style" href="{{ asset('assests/css/toastr.min.css') }}" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('assests/css/slick.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assests/css/slick-theme.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assests/css/toastr.min.css') }}">
    </noscript>
    {{-- Cookie consent CSS inlined (~1KB) to drop a render-blocking request while still preventing banner flash/CLS --}}
    <style>[class^=lcc-]{box-sizing:border-box!important;color:#111;font-size:16px;line-height:22px}[class^=lcc-]:first-child{margin-top:0}[class^=lcc-]:last-child{margin-bottom:0}[class^=lcc-][inert]{cursor:default;pointer-events:none}[class^=lcc-][inert],[class^=lcc-][inert] *{user-select:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none}.lcc-text{font-size:16px;margin:0 0 22px}.lcc-button{background:none;background-color:#111;border:1px solid #111;color:#fff;cursor:pointer;display:inline-block;font-size:inherit;margin:1px 0;outline:none;padding:6px 15px;transition:color .2s ease,background-color .2s ease,border-color .2s ease}.lcc-button:focus,.lcc-button:hover{background:#777;border-color:#777}.lcc-button.lcc-button--link{background:transparent;border-color:transparent;color:inherit;padding-left:0;padding-right:0;text-decoration:underline}.lcc-button.lcc-button--link:focus,.lcc-button.lcc-button--link:hover{background:transparent;border-color:transparent;text-decoration:none}.lcc-button.lcc-button--link+.lcc-button.lcc-button--link{margin-top:0}.lcc-label{align-items:baseline;display:flex;margin-bottom:5px}.lcc-label[for]{cursor:pointer}.lcc-label>*{margin-right:10px}input[id^=lcc-]:disabled{color:#777;cursor:default;opacity:.55}input[id^=lcc-]:disabled+span{cursor:default;opacity:.6}.lcc-backdrop{background:rgba(0,0,0,.6);bottom:0;left:0;position:fixed;right:0;top:0;transition:opacity .2s ease-in-out;z-index:10000}.lcc-modal{background:#fff;box-shadow:0 2px 10px rgba(0,0,0,.25);left:50%;max-height:90%;max-width:90%;overflow:auto;padding:30px;position:fixed;top:50%;transform:translate(-50%,-50%);width:475px;z-index:10001}.lcc-modal .lcc-modal__close{background:none;border:none;color:inherit;cursor:pointer;font-size:24px;line-height:1.25;position:absolute;right:0;top:0;transition:color .2s ease;width:30px}.lcc-modal .lcc-modal__close:focus,.lcc-modal .lcc-modal__close:hover{color:#777}.lcc-modal .lcc-modal__title{font-size:22px;margin-bottom:1em}.lcc-modal .lcc-modal__section{margin-bottom:20px}.lcc-modal .lcc-modal__actions{margin-top:30px}.lcc-modal .lcc-modal__actions>*{display:block;margin-top:8px}.lcc-modal.lcc-modal--settings{z-index:10002}.lcc-u-sr-only{clip:rect(0,0,0,0);border:0;height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px}.lcc-u-text-center{text-align:center!important}</style>
    @php
    $row_id = 0;
        if (!empty($row->id)) {
            $row_id = $row->id;
        }
    @endphp

    @if($row_id != 116)
        <style id="inline-other-page-css">{!! inline_css_asset('other-page.css') !!}</style>
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
 <?php 
    if (!empty($row->id) && $row->id == 116) {
        $row_id = $row->id;
 ?>
   <script type="application/ld+json">
    @verbatim
    {
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "LocalBusiness",
      "@id": "https://meissner-entruempelung.de/#company",
      "name": "Meissner Entrümpelung - Wohnungsauflösung & Entsorgung",
      "alternateName": "Meissner Entrümpelungsfirma Berlin",
      "description": "Meissner Entrümpelung ist ein professionelles Entrümpelungsunternehmen mit Sitz in Berlin, das sich auf Haushaltsauflösungen, Wohnungsentrümpelungen, Kellerentrümpelungen und Entsorgungsdienstleistungen spezialisiert hat. Das Unternehmen bietet umfassende Full-Service-Lösungen einschließlich Bewertung, fachgerechte Entsorgung, Reinigung, Wertstoffankauf und nachhaltige Recycling-Verfahren. Mit langjähriger Erfahrung bedient Meissner Entrümpelung Privat- und Gewerbekunden in Berlin, Brandenburg und deutschlandweit.",
      "url": "https://meissner-entruempelung.de/",
      "logo": "https://meissner-entruempelung.de/uploads/0000/1/2024/08/03/logo-site1.svg",
      "image": [
        "https://meissner-entruempelung.de/uploads/0000/1/2024/08/03/logo-site1.svg"
      ],
      "telephone": "+493041723130",
      "priceRange": "€€",
      "email": "info@meissner-entruempelung.de",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Oranienburger Str. 47",
        "addressLocality": "Berlin",
        "postalCode": "13437",
        "addressCountry": "DE"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 52.5876,
        "longitude": 13.3628
      },
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": [
            "https://schema.org/Monday",
            "https://schema.org/Tuesday",
            "https://schema.org/Wednesday",
            "https://schema.org/Thursday",
            "https://schema.org/Friday"
          ],
          "opens": "08:00",
          "closes": "19:00"
        }
      ],
      "contactPoint": [
        {
          "@type": "ContactPoint",
          "telephone": "+493041723130",
          "contactType": "customer service",
          "areaServed": "DE",
          "availableLanguage": [
            "de"
          ]
        }
      ],
      "areaServed": [
        {
          "@type": "City",
          "name": "Berlin",
          "containedInPlace": {
            "@type": "Country",
            "name": "Deutschland"
          }
        },
        {
          "@type": "Place",
          "name": "Berlin Mitte",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-mitte"
        },
        {
          "@type": "Place",
          "name": "Berlin Pankow",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-pankow"
        },
        {
          "@type": "Place",
          "name": "Berlin Neukölln",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-neukoelln"
        },
        {
          "@type": "Place",
          "name": "Berlin Charlottenburg",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-charlottenburg"
        },
        {
          "@type": "Place",
          "name": "Berlin Friedrichshain",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-friedrichshain"
        },
        {
          "@type": "Place",
          "name": "Berlin Lichtenberg",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-lichtenberg"
        },
        {
          "@type": "Place",
          "name": "Berlin Marzahn",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-marzahn"
        },
        {
          "@type": "Place",
          "name": "Berlin Wilmersdorf",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-wilmersdorf"
        },
        {
          "@type": "Place",
          "name": "Berlin Prenzlauer Berg",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-prenzlauer-berg"
        },
        {
          "@type": "Place",
          "name": "Berlin Reinickendorf",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-reinickendorf"
        },
        {
          "@type": "Place",
          "name": "Berlin Spandau",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-spandau"
        },
        {
          "@type": "Place",
          "name": "Berlin Steglitz",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-steglitz"
        },
        {
          "@type": "Place",
          "name": "Berlin Tempelhof",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-tempelhof"
        },
        {
          "@type": "Place",
          "name": "Berlin Tiergarten",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-tiergarten"
        },
        {
          "@type": "Place",
          "name": "Berlin Treptow",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-treptow"
        },
        {
          "@type": "Place",
          "name": "Berlin Wedding",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-wedding"
        },
        {
          "@type": "Place",
          "name": "Berlin Weissensee",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-weissensee"
        },
        {
          "@type": "Place",
          "name": "Berlin Hellersdorf",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-hellersdorf"
        },
        {
          "@type": "Place",
          "name": "Berlin Hohenschönhausen",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-hohenschoenhausen"
        },
        {
          "@type": "Place",
          "name": "Berlin Köpenick",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-koepenick"
        },
        {
          "@type": "Place",
          "name": "Berlin Kreuzberg",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-kreuzberg"
        },
        {
          "@type": "Place",
          "name": "Berlin Schöneberg",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-schoeneberg"
        },
        {
          "@type": "Place",
          "name": "Berlin Zehlendorf",
          "containedInPlace": {
            "@type": "City",
            "name": "Berlin"
          },
          "url": "https://meissner-entruempelung.de/berlin-zehlendorf"
        },
        {
          "@type": "Country",
          "name": "Deutschland",
          "alternateName": "Germany"
        }
      ],
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "5.0",
        "reviewCount": "32",
        "bestRating": "5"
      },
      "hasMap": "https://maps.app.goo.gl/PviBm5i3W8U2hQzm9"
    },
    {
      "@type": "Service",
      "@id": "https://meissner-entruempelung.de/#service",
      "serviceType": "Entrümpelung und Haushaltsauflösung",
      "provider": {
        "@id": "https://meissner-entruempelung.de/#company"
      },
      "areaServed": {
        "@type": "Country",
        "name": "Deutschland"
      },
      "availableChannel": {
        "@type": "ServiceChannel",
        "serviceUrl": "https://meissner-entruempelung.de/",
        "servicePhone": {
          "@type": "ContactPoint",
          "telephone": "+493041723130"
        }
      },
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Entrümpelungsleistungen",
        "itemListElement": [
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Haushaltsauflösung",
              "description": "Komplette Auflösung von Haushalten mit fachgerechter Entsorgung und Verwertung",
              "url": "https://meissner-entruempelung.de/haushaltsaufloesung-berlin/"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Wohnungsentrümpelung",
              "description": "Professionelle Entrümpelung von Wohnungen jeder Größe",
              "url": "https://meissner-entruempelung.de/wohnungsentruempelung-berlin/"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Wohnungsauflösung",
              "description": "Vollständige Auflösung von Wohnungen mit Entsorgung und Verwertung",
              "url": "https://meissner-entruempelung.de/wohnungsaufloesung-berlin/"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Kellerentrümpelung",
              "description": "Entrümpelung und Reinigung von Kellern und Abstellräumen",
              "url": "https://meissner-entruempelung.de/kellerentruempelung-berlin/"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Dachentrümpelung",
              "description": "Fachgerechte Räumung von Dachböden und Speichern",
              "url": "https://meissner-entruempelung.de/dachboden-entruempeln-berlin/"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Messie-Wohnung Entrümpelung",
              "description": "Einfühlsame Entrümpelung von Messie-Wohnungen",
              "url": "https://meissner-entruempelung.de/messie-entruempelung/"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Gewerbeentrümpelung",
              "description": "Entrümpelung von Geschäftsräumen und Betrieben",
              "url": "https://meissner-entruempelung.de/gewerbeaufloesung-berlin/"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Büroauflösung",
              "description": "Professionelle Auflösung von Büroräumen",
              "url": "https://meissner-entruempelung.de/bueroaufloesung-berlin/"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Nachlassauflösung",
              "description": "Würdevolle Auflösung von Nachlässen mit Wertanrechnung",
              "url": "https://meissner-entruempelung.de/nachlassraeumung-berlin/"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Sperrmüllabholung",
              "description": "Abholung und fachgerechte Entsorgung von Sperrmüll",
              "url": "https://meissner-entruempelung.de/sperrmuellabholung/"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Garage entrümpeln",
              "description": "Entrümpelung von Garagen und Carports",
              "url": "https://meissner-entruempelung.de/garage-entruempeln-berlin/"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Gartenentrümpelung",
              "description": "Entrümpelung von Gärten und Außenanlagen",
              "url": "https://meissner-entruempelung.de/garten-entruempeln-berlin/"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Firmenauflösung",
              "description": "Komplette Auflösung von Firmen und Betrieben",
              "url": "https://meissner-entruempelung.de/firmenaufloesung-berlin/"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Betriebsauflösung",
              "description": "Professionelle Betriebsauflösung mit Entsorgung",
              "url": "https://meissner-entruempelung.de/betriebsaufloesung-berlin/"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Geschäftsauflösung",
              "description": "Auflösung von Geschäften und Ladeneinrichtungen",
              "url": "https://meissner-entruempelung.de/geschaeftsaufloesung-berlin/"
            }
          }
        ]
      }
    }
  ]
}
    @endverbatim
   </script>
    <?php
    }
 ?>
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

{{-- jQuery moved out of <head> so it no longer blocks first render. Placed here (before the footer, @stack('js') and the inline scripts below) so every $-dependent script still runs after it. --}}
<script src="{{ asset('assests/js/jquery.min.js') }}"></script>
@include('Layout::parts.footer')
<script src="{{ asset('assests/js/toastr.min.js') }}" defer></script>
<script>
    var recaptchaPopupWidgetId;
    function onRecaptchaLoadCallback() {
        var popupEl = document.getElementById('recaptcha-popup');
        if (popupEl && !popupEl.hasChildNodes() && typeof grecaptcha !== 'undefined') {
            recaptchaPopupWidgetId = grecaptcha.render('recaptcha-popup', {
                sitekey: "{{ setting_item('recaptcha_api_key') }}"
            });
        }
    }
    (function () {
        var loaded = false;
        function loadRecaptcha() {
            if (loaded) return;
            loaded = true;
            var s = document.createElement('script');
            s.src = 'https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoadCallback';
            s.async = true;
            s.defer = true;
            document.head.appendChild(s);
            events.forEach(function (e) {
                window.removeEventListener(e, loadRecaptcha, { passive: true });
            });
        }
        var events = ['scroll', 'mousemove', 'touchstart', 'keydown', 'click'];
        events.forEach(function (e) {
            window.addEventListener(e, loadRecaptcha, { passive: true });
        });
        setTimeout(loadRecaptcha, 4000);
    })();
</script>
<script src="{{ asset('assests/js/slick.min.js') }}" defer></script>
<script src="{{ asset('assests/js/script.js') }}" defer></script>
@stack('js')
<script>

    $(document).ready(function(){

        $('.popup-contact-form [type=submit]').click(function (e) {

            e.preventDefault();
            let form = $(this).closest('.popup-form-elements');
            let captchaResponse = grecaptcha.getResponse(recaptchaPopupWidgetId);
            $.ajax({
                url: '{{ route('frontend.register.popup_contact') }}',
                data: {
                    'name': form.find('input[name=name]').val(),
                    'email': form.find('input[name=email]').val(),
                    'phone_no': form.find('input[name=phone_no]').val(),
                    // 'captcha': form.find('[name=captcha]').val(),
                    'g-recaptcha-response': captchaResponse,
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
