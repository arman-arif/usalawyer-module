<?php

return [
    'name' => 'Lawyer',
    'route_prefix' => '',
    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => app_path('Modules/Lawyer/storage'),
            'url' => env('APP_URL').'/modules/lawyer/storage',
            'visibility' => 'public',
        ],
    ],
];
