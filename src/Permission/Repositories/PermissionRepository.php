<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Permission\Repositories;

use Illuminate\Support\Collection;
use Zs\Foundation\Http\Abstracts\Repository;

/**
 * Class PermissionRepository.
 */
class PermissionRepository extends Repository
{
    /**
     * Initialize.
     *
     * @param \Illuminate\Support\Collection $collection
     */
    public function initialize(Collection $collection)
    {
        $collection->each(function ($definition, $identification) {
            $this->items[$identification] = $definition;
        });
    }
}
