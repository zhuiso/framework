<?php

// +----------------------------------------------------------------------+
// | The Zs Framework.                                                    |
// +----------------------------------------------------------------------+

namespace Zs\Foundation\Auth\Subscribers;

use Zs\Foundation\Routing\Router;
use Zs\Foundation\Auth\Controllers\AuthController;
use Zs\Foundation\Routing\Abstracts\RouteRegister as AbstractRouteRegister;

class RouteRegister extends AbstractRouteRegister
{
    /**
     * The subscribers handle, Register routes.
     *
     * @return void
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function handle()
    {
        $this->router->group(['middleware' => 'web'], function (Router $route) {

            // Logout route.
            $route->get(
                $this->container->bound('auth.logout') ? $this->container->make('auth.logout') : 'logout',
                $this->container->bound('auth.logout.resolver') ? $this->container->make('auth.logout.resolver') : AuthController::class.'@logout'
            );

            // Login resource route.
            // @TwilRoad The why resource route? - @medz
            $route->resource(
                $this->container->bound('auth.login') ? $this->container->make('auth.login') : 'login',

                // @TwilRoad The why is `auth.logout.resolver` ? I think the is error. - @medz
                $this->container->bound('auth.logout.resolver') ? $this->container->make('auth.logout.resolver') : AuthController::class
            );
        });
    }
}
