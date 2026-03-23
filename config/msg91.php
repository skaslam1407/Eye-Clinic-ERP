<?php

return [
    'auth_key' => env('MSG91_AUTH_KEY'),
    'sender' => env('MSG91_SENDER', 'TXTLAR'),
    'route' => env('MSG91_ROUTE', '4'), // 4 = transactional in MSG91
    'country' => env('MSG91_COUNTRY', '91'),
    'flow_id' => env('MSG91_FLOW_ID'), // optional: use Flow API if set
];
