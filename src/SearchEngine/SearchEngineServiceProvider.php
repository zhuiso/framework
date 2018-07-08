<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\SearchEngine;

use Illuminate\Events\Dispatcher;
use Zs\Foundation\Http\Abstracts\ServiceProvider;
use Zs\Foundation\SearchEngine\Subscribers\PermissionGroupRegister;
use Zs\Foundation\SearchEngine\Subscribers\PermissionRegister;
use Zs\Foundation\SearchEngine\Subscribers\RouterRegister;

/**
 * Class SearchEngineServiceProvider.
 */
class SearchEngineServiceProvider extends ServiceProvider
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
        return ['searchengine.optimization'];
    }

    /**
     * Register for service provider.
     */
    public function register()
    {
        $this->app->singleton('searchengine.optimization', function () {
            return new Optimization();
        });
    }
}
