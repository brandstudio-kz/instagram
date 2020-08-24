<?php

return [
    'prefix' => 'api/instagram',
    'middleware' => ['api'],

    'cache_lifetime' => 5, // in seconds

    'client_id' => env('FB_APP_ID'),
    'client_secret' => env('FB_APP_SECRET'),

    'cache_lifetime' => ceil(3 * 60 * 60 / 200),

    'posts_cnt' => 6
];
