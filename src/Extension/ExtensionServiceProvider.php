<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Extension;

use Zs\Foundation\Http\Abstracts\ServiceProvider;

/**
 * Class ExpandServiceProvider.
 */
class ExtensionServiceProvider extends ServiceProvider
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
        return ['extension'];
    }

    /**
     * Register service provider.
     */
    public function register()
    {
        $this->app->singleton('extension', function ($app) {
            return new ExtensionManager();
        });
    }
}
