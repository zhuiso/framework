<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Bootstraps;

use Zs\Foundation\Addon\Events\AddonLoaded;
use Zs\Foundation\Addon\Addon;
use Zs\Foundation\Http\Contracts\Bootstrap;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class LoadAddon.
 */
class LoadAddon implements Bootstrap
{
    use Helpers;

    /**
     * Bootstrap the given application.
     */
    public function bootstrap()
    {
        $this->addon->enabled()->each(function (Addon $addon) {
            $this->addon->registerExcept($addon->get('csrf', []));
            collect($addon->get('events', []))->each(function ($data, $key) {
                switch ($key) {
                    case 'subscribes':
                        collect($data)->each(function ($subscriber) {
                            if (class_exists($subscriber)) {
                                $this->events->subscribe($subscriber);
                            }
                        });
                        break;
                }
            });
            $this->container->register($addon->provider());
        });
        $this->event->dispatch(new AddonLoaded());
    }
}
