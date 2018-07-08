<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Routing;

use Illuminate\Routing\PendingResourceRegistration as IlluminatePendingResourceRegistration;

/**
 * Class PendingResourceRegistration.
 */
class PendingResourceRegistration extends IlluminatePendingResourceRegistration
{
    /**
     * @param array $methods
     *
     * @return $this
     */
    public function methods(array $methods)
    {
        $this->options['methods'] = $methods;

        return $this;
    }
}
