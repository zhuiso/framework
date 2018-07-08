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
 * Class Uninstaller.
 */
abstract class Uninstaller
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * Uninstaller constructor.
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
    public abstract function require();

    /**
     * @return bool
     */
    public function uninstall() {
        if (!$this->require()) {
            return false;
        }

        return $this->handle();
    }
}
