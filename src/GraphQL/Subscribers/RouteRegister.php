<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\GraphQL\Subscribers;

use Zs\Foundation\Routing\Router;
use Zs\Foundation\GraphQL\Controllers\GraphQLController;
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
        $this->router->group(['middleware' => [/*'auth:api', */'cross', 'web'], 'prefix' => 'api/administration'], function (Router $route) {
            $route->post('/', GraphQLController::class.'@query');
        });
    }
}
