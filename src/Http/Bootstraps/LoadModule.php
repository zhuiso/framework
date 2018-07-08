<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Bootstraps;

use Zs\Foundation\Http\Contracts\Bootstrap;
use Zs\Foundation\Module\Module;
use Zs\Foundation\Module\ModuleLoaded;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class LoadModule.
 */
class LoadModule implements Bootstrap
{
    use Helpers;

    /**
     * Bootstrap the given application.
     */
    public function bootstrap()
    {
        if ($this->container->isInstalled()) {
            $this->module->enabled()->each(function (Module $module) {
                $this->module->registerExcept($module->get('csrf', []));
                collect($module->get('events', []))->each(function ($data, $key) {
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
                $schemas = $module->get('graphql.schemas', []);
                foreach ($schemas as $key => $value) {
                    if (isset($value['query']) && is_array($value['query']) && count($value['query']) > 0) {
                        $key = 'graphql.schemas.' . $key . '.query';
                        $queries = collect($this->config->get($key, []));
                        if ($queries->isEmpty()) {
                            $queries = collect($value['query']);
                        } else {
                            $queries = $queries->merge((array)$value['query']);
                        }
                        $this->config->set($key, $queries->toArray());
                    }
                    if (isset($value['mutation']) && is_array($value['mutation']) && count($value['mutation']) > 0) {
                        $key = 'graphql.schemas.' . $key . '.mutation';
                        $mutations = collect($this->config->get($key, []));
                        if ($mutations->isEmpty()) {
                            $mutations = collect($value['query']);
                        } else {
                            $mutations = $mutations->merge((array)$value['query']);
                        }
                        $this->config->set($key, $mutations->toArray());
                    }
                }
                $types = collect($this->config->get('graphql.types'));
                $types = $types->merge($module->get('graphql.types', []));
                $this->config->set('graphql.types', $types->toArray());
                $providers = collect($this->config->get('app.providers'));
                $providers->push($module->service());
                collect($module->get('providers', []))->each(function ($provider) use ($providers) {
                    $providers->push($provider);
                });
                $this->config->set('app.providers', $providers->toArray());
            });
        }
        $this->event->dispatch(new ModuleLoaded());
    }
}
