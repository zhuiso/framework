<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Routing;

use Illuminate\Routing\Router as IlluminateRouter;

/**
 * Class Router.
 */
class Router extends IlluminateRouter
{
    /**
     * Route a resource to a controller.
     *
     * @param string $name
     * @param string $controller
     * @param array  $options
     *
     * @return \Zs\Foundation\Routing\PendingResourceRegistration
     */
    public function resource($name, $controller, array $options = [])
    {
        $registrar = new ResourceRegistrar($this);

        return new PendingResourceRegistration(
            $registrar, $name, $controller, $options
        );
    }
}