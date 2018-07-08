<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Bootstraps;

use Illuminate\Http\Request;
use Zs\Foundation\Http\Contracts\Bootstrap;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class SetRequestForConsole.
 */
class SetRequestForConsole implements Bootstrap
{
    use Helpers;

    /**
     * Bootstrap the given application.
     */
    public function bootstrap()
    {
        $url = $this->config->get('app.url', 'http://localhost');
        $this->container->instance('request', Request::create($url, 'GET', [], [], [], $_SERVER));
    }
}
