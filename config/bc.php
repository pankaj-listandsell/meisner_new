<?php
return [
    'active_theme' => isset($_GET['_xtheme']) ? $_GET['_xtheme'] : env('BC_ACTIVE_THEME', defined('BC_INITIAL_THEME') ? BC_INITIAL_THEME : 'base'),
    "media" => [
        "groups" => [
            "default" => [
                "ext" => ["jpg", "jpeg", "png", "gif", "bmp", "docx", "webp", "svg"],
                "mime" => ["image/webp", "image/png", "image/jpeg", "image/gif", "image/bmp", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "image/svg+xml"],
                "max_size" => 20000000, // In Bytes, default is 20MB,
                "max_width" => env('ALLOW_IMAGE_MAX_WIDTH', 2500),
                "max_height" => env('ALLOW_IMAGE_MAX_HEIGHT', 2500)
            ],
            "image" => [
                "ext" => ["jpg", "jpeg", "png", "gif", "bmp", "webp", "svg"],
                "mime" => ["image/png", "image/jpeg", "image/gif", "image/bmp", "image/webp", "image/svg+xml"],
                "max_size" => 20000000, // In Bytes, default is 20MB,
                "max_width" => env('ALLOW_IMAGE_MAX_WIDTH', 2500),
                "max_height" => env('ALLOW_IMAGE_MAX_HEIGHT', 2500)
            ],
        ],
        "optimize_image" => env('BC_MEDIA_OPTIMIZE_IMAGE', true),
        "preview_direct" => env("BC_MEDIA_PREVIEW_DIRECT", true)
    ],
    'disable_require_change_pw' => env('DISABLE_REQUIRE_CHANGE_PW', false)
];
