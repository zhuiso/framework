<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Addon\Abstracts;

use Illuminate\Container\Container;

/**
 * Class Installer.
 */
abstract class Installer
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * Installer constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return bool
     */
    abstract public function handle();

    /**
     * @return bool
     */
    public function install()
    {
        if (!$this->require()) {
            return false;
        }
        return $this->handle();
    }

    /**
     * @return bool
     */
    abstract public function require();
}
