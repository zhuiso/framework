<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Module\Abstracts;

/**
 * Class Installation.
 */
abstract class Installation
{
    /**
     * Pre-handle for install.
     */
    abstract public function preInstall();

    /**
     * Pre-handle for uninstall.
     */
    abstract public function preUninstall();

    /**
     * Post-handle for install.
     */
    abstract public function postInstall();

    /**
     * Post-handle for uninstall
     */
    abstract public function postUninstall();
}
