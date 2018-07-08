<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Addon\Subscribers;

use Zs\Foundation\Addon\Controllers\AddonsController;
use Zs\Foundation\Addon\Controllers\AddonsExportsController;
use Zs\Foundation\Addon\Controllers\AddonsImportsController;
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
            $this->router->resource('addons/{addon}/exports', AddonsExportsController::class)->methods([
                'store' => 'export',
            ])->names([
                'store' => 'addons.exports',
            ])->only([
                'store',
            ]);
            $this->router->resource('addons/{addon}/imports', AddonsImportsController::class)->methods([
                'store' => 'import',
            ])->names([
                'store' => 'addons.imports',
            ])->only([
                'store',
            ]);
            $this->router->resource('addons', AddonsController::class)->methods([
                'destroy' => 'uninstall',
                'index'   => 'list',
                'store'   => 'install',
                'update'  => 'enable',
            ])->names([
                'destroy' => 'addons.uninstall',
                'index'   => 'addons.list',
                'store'   => 'addons.install',
                'update'  => 'addons.enable',
            ])->only([
                'destroy',
                'index',
                'store',
                'update',
            ]);
        });
    }
}
