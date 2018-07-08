<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Facades;

use Illuminate\Container\Container;
use Zs\Foundation\AliasLoader;

/**
 * Class FacadeRegister.
 */
class FacadeRegister
{
    /**
     * @var \Zs\Foundation\AliasLoader
     */
    protected $aliasLoader;

    /**
     * FacadeRegister constructor.
     *
     * @param \Zs\Foundation\AliasLoader $aliasLoader
     *
     * @internal param \Illuminate\Container\Container|\Illuminate\Contracts\Foundation\Application $container
     */
    public function __construct(AliasLoader $aliasLoader)
    {
        $this->aliasLoader = $aliasLoader;
    }

    /**
     * @param $key
     * @param $path
     */
    public function register($key, $path) {
        $this->aliasLoader->alias($path, $key);
    }
}
