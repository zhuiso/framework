<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
return [
    'defaults'  => [
        'guard'     => 'web',
        'passwords' => 'users',
    ],
    'guards'    => [
        'api' => [
            'driver'   => 'jwt',
            'provider' => 'users',
        ],
        'web' => [
            'driver'   => 'session',
            'provider' => 'users',
        ],
    ],
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  => Zs\Foundation\Member\Member::class,
        ],
    ],
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table'    => 'password_resets',
            'expire'   => 60,
        ],
    ],
];
