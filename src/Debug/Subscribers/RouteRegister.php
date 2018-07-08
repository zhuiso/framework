<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Debug\Subscribers;

use Zs\Foundation\Debug\Controllers\ConfigurationsController;
use Zs\Foundation\Routing\Abstracts\RouteRegister as AbstractRouteRegister;

/**
 * Class RouteRegister.
 */
class RouteRegister extends AbstractRouteRegister
{
    /**
     * Handle Route Register.
     */
    public function handle()
    {
        $this->router->group([
            'middleware' => ['auth:api', 'cross', 'web'],
            'prefix'     => 'api/administration/debug',
        ], function () {
            $this->router->resource('configurations', ConfigurationsController::class)->methods([
                'index' => 'list',
            ])->names([
                'index' => 'debug.configurations.list',
                'store' => 'debug.configurations.store',
            ])->only([
                'index',
                'store',
            ]);
        });
    }
}
