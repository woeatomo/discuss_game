<?php

return [
    'apps' => [
        [
            'id' => env('PUSHER_APP_ID'),
            'name' => env('APP_NAME'),
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'path' => '',
            'capacity' => null,
            'enable_client_messages' => true,
            'enable_statistics' => true,
        ],
    ],

    'dashboard' => [
        'middleware' => [
            'web',
            'auth',
        ],
    ],

    'debug' => env('WEBSOCKETS_DEBUG', false),
    'ssl' => [
        'local_cert' => null,
        'local_pk' => null,
        'passphrase' => null,
        'verify_peer' => false,
    ],
];