<?php

return [
    'site_key' => env('RECAPTCHA_SITE_KEY', env('NOCAPTCHA_SITEKEY')),
    'secret' => env('RECAPTCHA_SECRET', env('NOCAPTCHA_SECRET')),
    'verify_url' => env('RECAPTCHA_VERIFY_URL', 'https://www.google.com/recaptcha/api/siteverify'),
    'timeout' => (int) env('RECAPTCHA_TIMEOUT', 3),
    'retries' => (int) env('RECAPTCHA_RETRIES', 2),
];
