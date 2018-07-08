<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Bootstraps;

use Zs\Foundation\Http\Contracts\Bootstrap;
use Zs\Foundation\Routing\Events\RouteRegister;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class RegisterRouter.
 */
class RegisterRouter implements Bootstrap
{
    use Helpers;

    /**
     * Bootstrap the given application.
     */
    public function bootstrap()
    {
        if ($this->container->isInstalled()) {
            if ($this->container->routesAreCached()) {
                $this->container->booted(function () {
                    require $this->container->getCachedRoutesPath();
                });
            } else {
                $this->event->dispatch(new RouteRegister($this->container['router']));
                $this->container->booted(function () {
                    $this->container['router']->getRoutes()->refreshNameLookups();
                });
            }
        }
    }
}
