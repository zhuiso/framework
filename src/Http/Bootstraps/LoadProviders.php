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
use Zs\Foundation\Http\Events\ProviderLoaded;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class BootProviders.
 */
class LoadProviders implements Bootstrap
{
    use Helpers;

    /**
     * Bootstrap the given application.
     */
    public function bootstrap()
    {
        $this->container->registerConfiguredProviders();
        $this->container->boot();
        $this->container->make('events')->dispatch(new ProviderLoaded());
    }
}
