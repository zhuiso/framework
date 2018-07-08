<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Routing\Traits;

/**
 * Trait Permissionable.
 */
trait Permissionable
{
    /**
     * Check for permission.
     *
     * @param $key
     *
     * @return bool
     */
    protected function permission($key)
    {
        return $this->container->make('permission')->check($key);
    }
}
