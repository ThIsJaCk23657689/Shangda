<?php

return [
    'ssr' => [
        'enabled' => env('INERTIA_SSR_ENABLED', false),
        'url' => env('INERTIA_SSR_URL', 'http://127.0.0.1:13714'),
    ],
    'pages' => [
        'paths' => [resource_path('js/Pages')],
        'extensions' => ['ts', 'vue'],
    ],
    'testing' => [
        'ensure_pages_exist' => true,
    ],
];
