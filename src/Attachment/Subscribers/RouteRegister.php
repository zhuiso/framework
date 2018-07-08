<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Attachment\Subscribers;

use Zs\Foundation\Attachment\Controllers\CdnController;
use Zs\Foundation\Attachment\Controllers\ConfigurationsController;
use Zs\Foundation\Attachment\Controllers\StorageController;
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
        $this->router->group(['middleware' => ['auth:api', 'cross', 'web'], 'prefix' => 'api/attachment'], function () {
            $this->router->post('cdn', CdnController::class . '@handle');
            $this->router->post('storage', StorageController::class . '@handle');
        });
        $this->router->group([
            'middleware' => ['auth:api', 'cross', 'web'],
            'prefix'     => 'api/administration/attachment',
        ], function () {
            $this->router->resource('configurations', ConfigurationsController::class)->methods([
                'index' => 'list',
            ])->only([
                'index',
                'store',
            ]);
        });
    }
}
