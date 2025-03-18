<?php
return [
'default' => env('BROADCAST_DRIVER', 'pusher'),

'connections' => [
'pusher' => [
'driver' => 'pusher',
'key' => env('PUSHER_APP_KEY'),
'secret' => env('PUSHER_APP_SECRET'),
'app_id' => env('PUSHER_APP_ID'),
'options' => [
'cluster' => env('PUSHER_CLUSTER'),
'useTLS' => false, // ✅ Ensure TLS is disabled for local development
'host' => env('PUSHER_HOST', '127.0.0.1'),
'port' => env('PUSHER_PORT', 6001),
'scheme' => env('PUSHER_SCHEME', 'http'),
],
],
],
];
