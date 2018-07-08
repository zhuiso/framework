<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Setting\Subscribers;

use Zs\Foundation\Routing\Abstracts\RouteRegister as AbstractRouteRegister;
use Zs\Foundation\Setting\Controllers\SettingController;

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
        $this->router->group(['middleware' => ['auth:api', 'cross', 'web'], 'prefix' => 'api/setting'], function () {
            $this->router->post('all', SettingController::class . '@all');
            $this->router->post('set', SettingController::class . '@handler');
        });
    }
}
