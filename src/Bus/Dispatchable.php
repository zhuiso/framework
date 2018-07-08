<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Bus;

/**
 * Trait Dispatchable.
 */
trait Dispatchable
{
    /**
     * Dispatch the job with the given arguments.
     *
     * @return \Zs\Foundation\Bus\PendingDispatch
     */
    public static function dispatch()
    {
        return new PendingDispatch(new static(...func_get_args()));
    }

    /**
     * Set the jobs that should run if this job is successful.
     *
     * @param  array  $chain
     *
     * @return \Zs\Foundation\Bus\PendingChain
     */
    public static function withChain($chain)
    {
        return new PendingChain(get_called_class(), $chain);
    }
}