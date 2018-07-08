<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Bootstraps;

use Zs\Foundation\Flow\Events\FlowRegister;
use Zs\Foundation\Http\Contracts\Bootstrap;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class RegisterFlow.
 */
class RegisterFlow implements Bootstrap
{
    use Helpers;

    /**
     * Bootstrap the given application.
     */
    public function bootstrap()
    {
        $this->event->dispatch(new FlowRegister($this->container['flow']));
    }
}
