<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Extension\Subscribers;

use Zs\Foundation\Extension\Controllers\ExtensionsController;
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
        $this->router->group(['middleware' => ['auth:api', 'cross', 'web'], 'prefix' => 'api/administration'], function () {
            $this->router->resource('extensions', ExtensionsController::class)->methods([
                'destroy' => 'uninstall',
                'store' => 'install',
            ])->names([
                'destroy' => 'addons.uninstall',
                'store' => 'extensions.install',
            ])->only([
                'destroy',
                'store',
            ]);
        });
    }
}
