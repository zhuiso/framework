<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Extension\Abstracts;

/**
 * Class Uninstaller.
 */
abstract class Uninstaller
{
    /**
     * @return true
     */
    abstract public function handle();
}