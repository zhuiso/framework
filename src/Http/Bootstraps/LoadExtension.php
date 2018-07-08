<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Bootstraps;

use Zs\Foundation\Extension\Extension;
use Zs\Foundation\Http\Contracts\Bootstrap;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class LoadExtension.
 */
class LoadExtension implements Bootstrap
{
    use Helpers;

    /**
     * Bootstrap the given application.
     */
    public function bootstrap()
    {
        $this->container->isInstalled() && $this->extension->repository()->each(function (Extension $extension) {
            $providers = collect($this->config->get('app.providers'));
            $providers->push($extension->service());
            $this->config->set('app.providers', $providers->toArray());
        });
    }
}
