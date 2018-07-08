<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Bootstraps;

use Illuminate\Support\Facades\Facade;
use Zs\Foundation\AliasLoader;
use Zs\Foundation\Facades\FacadeRegister;
use Zs\Foundation\Http\Contracts\Bootstrap;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class RegisterFacades.
 */
class RegisterFacades implements Bootstrap
{
    use Helpers;

    /**
     * Bootstrap the given application.
     */
    public function bootstrap()
    {
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($this->container);
        $aliasLoader = AliasLoader::getInstance($this->container->make('config')->get('app.aliases', []));
        $this->container->make('events')->dispatch(new FacadeRegister($aliasLoader));
        $aliasLoader->register();
    }
}
