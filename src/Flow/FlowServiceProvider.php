<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Flow;

use Zs\Foundation\Http\Abstracts\ServiceProvider;

/**
 * Class FlowServiceProvider.
 */
class FlowServiceProvider extends ServiceProvider
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
        return ['flow'];
    }

    /**
     * Register service to provider.
     */
    public function register()
    {
        $this->app->singleton('flow', function () {
            return new FlowManager();
        });
    }
}
