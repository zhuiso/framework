<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Routing\Events;

use Illuminate\Routing\Router;

/**
 * Class RouteRegister.
 */
class RouteRegister
{
    /**
     * @var \Illuminate\Routing\Router
     */
    protected $router;

    /**
     * RouteRegister constructor.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @internal param \Illuminate\Container\Container|\Illuminate\Contracts\Foundation\Application $container
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }
}
