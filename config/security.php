<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Security Headers
    |--------------------------------------------------------------------------
    |
    | Keep local development behavior unchanged by default. In production,
    | headers are enabled automatically unless SECURITY_HEADERS_ENABLED is set.
    |
    */

    'headers_enabled' => env('SECURITY_HEADERS_ENABLED', env('APP_ENV') === 'production'),

    /*
    |--------------------------------------------------------------------------
    | Strict Transport Security (HSTS)
    |--------------------------------------------------------------------------
    |
    | Applied only on HTTPS requests to avoid issues on local HTTP setups.
    |
    */

    'hsts_enabled' => env('SECURITY_HSTS_ENABLED', env('APP_ENV') === 'production'),
    'hsts_max_age' => (int) env('SECURITY_HSTS_MAX_AGE', 31536000),
    'hsts_include_subdomains' => env('SECURITY_HSTS_INCLUDE_SUBDOMAINS', true),
    'hsts_preload' => env('SECURITY_HSTS_PRELOAD', false),

    /*
    |--------------------------------------------------------------------------
    | Header Values
    |--------------------------------------------------------------------------
    |
    | Conservative defaults that improve baseline security without changing
    | app behavior (no CSP enforcement here to avoid breaking current scripts).
    |
    */

    'x_content_type_options' => 'nosniff',
    'x_frame_options' => 'SAMEORIGIN',
    'referrer_policy' => 'strict-origin-when-cross-origin',
    'permissions_policy' => "camera=(), microphone=(), geolocation=(), payment=(), usb=(), magnetometer=(), gyroscope=()",
    'x_permitted_cross_domain_policies' => 'none',
];
