<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\SearchEngine\Subscribers;

use Zs\Foundation\Routing\Abstracts\RouteRegister as AbstractRouteRegister;
use Zs\Foundation\SearchEngine\Controllers\SeoController;

/**
 * Class RouterRegister.
 */
class RouterRegister extends AbstractRouteRegister
{
    /**
     * Handle Route Register.
     */
    public function handle()
    {
        $this->router->group(['middleware' => ['auth:api', 'cross', 'web'], 'prefix' => 'api/administration/seo'], function () {
            $this->router->post('/', SeoController::class . '@seo');
            $this->router->post('batch', SeoController::class . '@batch');
            $this->router->post('create', SeoController::class . '@create');
            $this->router->post('edit', SeoController::class . '@edit');
            $this->router->post('list', SeoController::class . '@list');
            $this->router->post('order', SeoController::class . '@order');
            $this->router->post('module', SeoController::class . '@module');
            $this->router->post('remove', SeoController::class . '@remove');
            $this->router->post('template', SeoController::class . '@template');
        });
    }
}
