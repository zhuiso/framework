<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
return [
    'default'     => env('QUEUE_DRIVER', 'sync'),
    'connections' => [
        'sync'       => [
            'driver' => 'sync',
        ],
        'database'   => [
            'driver'      => 'database',
            'table'       => 'jobs',
            'queue'       => 'default',
            'retry_after' => 90,
        ],
        'beanstalkd' => [
            'driver'      => 'beanstalkd',
            'host'        => 'localhost',
            'queue'       => 'default',
            'retry_after' => 90,
        ],
        'sqs'        => [
            'driver' => 'sqs',
            'key'    => 'your-public-key',
            'secret' => 'your-secret-key',
            'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
            'queue'  => 'your-queue-name',
            'region' => 'us-east-1',
        ],
        'redis'      => [
            'driver'      => 'redis',
            'connection'  => 'default',
            'queue'       => 'default',
            'retry_after' => 90,
        ],
    ],
    'failed'      => [
        'database' => env('DB_CONNECTION', 'mysql'),
        'table'    => 'failed_jobs',
    ],
];
