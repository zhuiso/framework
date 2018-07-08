<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Module\Repositories;

use Illuminate\Support\Collection;
use Zs\Foundation\Http\Abstracts\Repository;

/**
 * Class PageRepository.
 */
class PageRepository extends Repository
{
    /**
     * Initialize.
     *
     * @param \Illuminate\Support\Collection $data
     */
    public function initialize(Collection $data)
    {
        if ($this->container->isInstalled()) {
            $this->items = $this->cache->tags('zs')->rememberForever('module.page.repository', function () use ($data) {
                $collection = collect();
                $data->each(function ($items, $module) use ($collection) {
                    collect($items)->each(function ($definition, $identification) use ($collection, $module) {
                        $key = $module . '/' . $identification;
                        $collection->put($key, $definition);
                    });
                });
                $collection->transform(function ($definition) {
                    data_set($definition, 'tabs', collect($definition['tabs'])->map(function ($definition) {
                        data_set($definition, 'fields', collect($definition['fields'])->map(function ($definition) {
                            $setting = $this->setting->get($definition['key'], '');
                            if (isset($definition['format'])) {
                                switch ($definition['format']) {
                                    case 'boolean':
                                        $definition['value'] = boolval($setting);
                                        break;
                                    default:
                                        $definition['value'] = $setting;
                                        break;
                                }
                            } else {
                                $definition['value'] = $setting;
                            }

                            return $definition;
                        }));

                        return $definition;
                    }));

                    return $definition;
                });

                return $collection->all();
            });
        }
    }
}
