<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Navigation\Subscribers;

use Zs\Foundation\Navigation\Controllers\GroupController;
use Zs\Foundation\Navigation\Controllers\ItemController;
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
        $this->router->group(['middleware' => ['auth:api', 'cross', 'web'], 'prefix' => 'api/navigation'], function () {
            $this->router->post('group/create', GroupController::class . '@create');
            $this->router->post('group/delete', GroupController::class . '@delete');
            $this->router->post('group/edit', GroupController::class . '@edit');
            $this->router->post('group/fetch', GroupController::class . '@fetch');
            $this->router->post('item/create', ItemController::class . '@create');
            $this->router->post('item/delete', ItemController::class . '@delete');
            $this->router->post('item/edit', ItemController::class . '@edit');
            $this->router->post('item/fetch', ItemController::class . '@fetch');
            $this->router->post('item/sort', ItemController::class . '@sort');
        });
    }
}
