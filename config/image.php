<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    | NOTE: Intervention Image v3 expects the driver CLASS here; the v2 "gd"/"imagick"
    | string no longer resolves ("Unable to resolve driver"). GD matches the prior config.
    |
    */

    'driver' => \Intervention\Image\Drivers\Gd\Driver::class,

];
