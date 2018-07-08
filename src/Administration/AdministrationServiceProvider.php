<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Administration;

use Zs\Foundation\Http\Abstracts\ServiceProvider;

/**
 * Class AdministrationServiceProvider.
 */
class AdministrationServiceProvider extends ServiceProvider
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
        return ['administration'];
    }

    /**
     * Register for service provider.
     */
    public function register()
    {
        $this->app->singleton('administration', function () {
            return new AdministrationManager();
        });
    }
}
