<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Routing\Abstracts;

use Illuminate\Routing\Controller as IlluminateController;
use Zs\Foundation\Routing\Traits\Helpers;
use Zs\Foundation\Routing\Traits\Permissionable;
use Zs\Foundation\Routing\Traits\Viewable;
use Zs\Foundation\Validation\ValidatesRequests;

/**
 * Class Controller.
 */
abstract class Controller extends IlluminateController
{
    use Helpers, Permissionable, ValidatesRequests, Viewable;

    /**
     * @var array
     */
    protected $permissions = [];

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        if ($this->permissions) {
            foreach ($this->permissions as $permission => $methods) {
                $this->middleware('permission:' . $permission)->only($methods);
            }
        }
    }

    /**
     * Get a command from console instance.
     *
     * @param string $name
     *
     * @return \Zs\Foundation\Console\Abstracts\Command|\Symfony\Component\Console\Command\Command
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getCommand($name)
    {
        return $this->getConsole()->get($name);
    }
}
