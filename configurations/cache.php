<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
return [
    'default' => env('CACHE_DRIVER', 'file'),
    'stores'  => [
        'apc'       => [
            'driver' => 'apc',
        ],
        'array'     => [
            'driver' => 'array',
        ],
        'database'  => [
            'driver'     => 'database',
            'table'      => 'cache',
            'connection' => null,
        ],
        'file'      => [
            'driver' => 'file',
            'path'   => storage_path('caches'),
        ],
        'memcached' => [
            'driver'        => 'memcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
            'sasl'          => [
                env('MEMCACHED_USERNAME'),
                env('MEMCACHED_PASSWORD'),
            ],
            'options'       => [
            ],
            'servers'       => [
                [
                    'host'   => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port'   => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],
        'redis'     => [
            'driver'     => 'redis',
            'connection' => 'default',
        ],
    ],
    'prefix'  => env('CACHE_PREFIX', str_slug(env('APP_NAME', 'zs'), '_') . '_cache'),
];