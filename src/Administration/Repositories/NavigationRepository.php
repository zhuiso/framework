<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Administration\Repositories;

use Illuminate\Support\Collection;
use Zs\Foundation\Http\Abstracts\Repository;

/**
 * Class NavigationRepository.
 */
class NavigationRepository extends Repository
{
    /**
     * Initialize.
     *
     * @param \Illuminate\Support\Collection $data
     */
    public function initialize(Collection $data)
    {
        if ($this->container->isInstalled()) {
            $this->items = $this->cache->tags('zs')->rememberForever('administration.navigation.repository', function () use ($data) {
                return $data->all();
            });
        }
    }
}
