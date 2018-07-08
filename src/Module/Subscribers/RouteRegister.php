<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Module\Subscribers;

use Zs\Foundation\Module\Controllers\ModuleController;
use Zs\Foundation\Module\Controllers\ModulesController;
use Zs\Foundation\Module\Controllers\ModulesDomainsController;
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
            $this->router->resource('modules/domains', ModulesDomainsController::class)->methods([
                'store' => 'update',
            ])->names([
                'store' => 'domains.update',
            ])->only([
                'store',
            ]);
            $this->router->resource('modules', ModulesController::class)->methods([
                'destroy' => 'uninstall',
                'index'   => 'list',
                'store'   => 'install',
                'update'  => 'enable',
            ])->names([
                'destroy' => 'modules.uninstall',
                'index'   => 'modules.list',
                'store'   => 'modules.install',
                'update'  => 'modules.enable',
            ])->only([
                'destroy',
                'index',
                'store',
                'update',
            ]);
        });
        $this->router->group(['middleware' => ['auth:api', 'cross', 'web'], 'prefix' => 'api'], function () {
            $this->router->post('module/exports', ModuleController::class . '@exports');
            $this->router->post('module/imports', ModuleController::class . '@imports');
            $this->router->post('module/update', ModuleController::class . '@update');
        });
    }
}
