<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Theme;

use Zs\Foundation\Http\Abstracts\ServiceProvider;

/**
 * Class ThemeServiceProvider.
 */
class ThemeServiceProvider extends ServiceProvider
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
        return ['theme'];
    }

    /**
     * Register service provider.
     */
    public function register()
    {
        $this->app->singleton('theme', function () {
            return new ThemeManager();
        });
    }
}
