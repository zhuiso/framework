<?php

// +----------------------------------------------------------------------+
// | The Zs Framework.                                                    |
// +----------------------------------------------------------------------+

namespace Zs\Foundation\Addon;

use Zs\Foundation\Http\Abstracts\ServiceProvider;

class AddonServiceProvider extends ServiceProvider
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
        return ['addon'];
    }

    /**
     * Register the service provider.
     *
     * @return void
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function register()
    {
        $this->app->singleton('addon', function () {
            return new AddonManager();
        });
    }
}
