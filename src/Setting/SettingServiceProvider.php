<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Setting;

use Zs\Foundation\Http\Abstracts\ServiceProvider;
use Zs\Foundation\Module\Module;

/**
 * Class SettingServiceProvider.
 */
class SettingServiceProvider extends ServiceProvider
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
        return ['setting'];
    }

    /**
     * Register for service provider.
     */
    public function register()
    {
        $this->app->singleton('setting', function () {
            $database = new DatabaseSettingsRepository($this->app->make('db.connection'));
            $cached = new MemoryCacheSettingsRepository($database);
            if ($this->app->isInstalled()) {
                $this->app->make('module')->repository()->each(function (Module $module) use ($cached) {
                    if ($module->offsetExists('settings')) {
                        foreach ((array)$module->get('settings') as $key => $definition) {
                            $cached->registerFormat($key, $definition);
                        }
                    }
                });
            }

            return $cached;
        });
    }
}
