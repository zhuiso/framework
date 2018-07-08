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
 * Class PageRepository.
 */
class PageRepository extends Repository
{
    /**
     * Initialize.
     *
     * @param \Illuminate\Support\Collection $collection
     */
    public function initialize(Collection $collection)
    {
        $this->module->pages()->each(function ($definition) {
            $this->items[] = $definition;
        });
    }
}
