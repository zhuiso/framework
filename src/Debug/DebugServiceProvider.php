<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Debug;

use Zs\Foundation\Http\Abstracts\ServiceProvider;

/**
 * Class DebugServiceProvider.
 */
class DebugServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;
}
