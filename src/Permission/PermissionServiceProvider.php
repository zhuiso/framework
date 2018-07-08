<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Permission;

use Zs\Foundation\Http\Abstracts\ServiceProvider;

/**
 * Class PermissionServiceProvider.
 */
class PermissionServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * @return array
     */
    public function provides()
    {
        return [
            'permission',
            'permission.group',
            'permission.module',
            'permission.type',
        ];
    }

    /**
     * ServiceProvider register.
     */
    public function register()
    {
        $this->app->singleton('permission', function ($app) {
            return new PermissionManager();
        });
    }
}
