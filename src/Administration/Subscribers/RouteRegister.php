<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Administration\Subscribers;

use Zs\Foundation\Administration\Controllers\AdministrationController;
use Zs\Foundation\Administration\Controllers\ConfigurationsController;
use Zs\Foundation\Administration\Controllers\DashboardsController;
use Zs\Foundation\Administration\Controllers\InformationsController;
use Zs\Foundation\Administration\Controllers\MenusController;
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
        $this->router->group(['middleware' => ['cross', 'web'], 'prefix' => 'api/administration'], function () {
            $this->router->post('token', AdministrationController::class . '@token');
        });
        $this->router->group(['middleware' => ['auth:api', 'cross', 'web'], 'prefix' => 'api/administration'], function () {
            $this->router->post('access', AdministrationController::class . '@access');
            $this->router->resource('configurations', ConfigurationsController::class)->methods([
                'show' => 'definition',
            ])->names([
                'show' => 'configurations.definition',
            ])->only([
                'show',
                'store',
            ]);
            $this->router->resource('dashboards', DashboardsController::class)->methods([
                'index' => 'list',
            ])->names([
                'index' => 'dashboards.list',
            ])->only([
                'index',
                'store',
            ]);
            $this->router->resource('informations', InformationsController::class)->methods([
                'store' => 'list',
            ])->names([
                'store' => 'information.list',
            ])->only([
                'store',
            ]);
            $this->router->resource('menus', MenusController::class)->methods([
                'index' => 'list',
                'store' => 'update',
            ])->names([
                'index' => 'menus.list',
                'store' => 'menus.update',
            ])->only([
                'index',
                'store',
            ]);
        });
    }
}
