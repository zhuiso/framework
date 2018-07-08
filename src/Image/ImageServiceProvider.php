<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image;

use Zs\Foundation\Http\Abstracts\ServiceProvider;

/**
 * Class ImageServiceProvider.
 */
class ImageServiceProvider extends ServiceProvider
{
    /**
     * Determines if Intervention Imagecache is installed
     *
     * @return bool
     */
    private function cacheIsInstalled()
    {
        return class_exists('Zs\\Image\\ImageCache');
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->cacheIsInstalled() ? $this->bootstrapImageCache() : null;
    }

    /**
     * Bootstrap imagecache
     *
     * @return void
     */
    private function bootstrapImageCache()
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('images', function () {
            return new ImageManager($this->app['config']->get('image'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'image',
        ];
    }
}
