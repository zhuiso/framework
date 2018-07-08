<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Permission;

use Zs\Foundation\Module\Module;
use Zs\Foundation\Permission\Repositories\PermissionRepository;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class PermissionManager.
 */
class PermissionManager
{
    use Helpers;

    /**
     * @var \Zs\Foundation\Permission\Repositories\PermissionRepository
     */
    protected $repository;

    /**
     * @param $identification
     * @param $group
     *
     * @return bool
     */
    public function check($identification, $group)
    {
        return true;
    }

    /**
     * @return \Zs\Foundation\Permission\Repositories\PermissionRepository
     */
    public function repository(): PermissionRepository
    {
        if (!$this->repository instanceof PermissionRepository) {
            $this->repository = new PermissionRepository();
            $collection = collect();
            $this->module->enabled()->each(function (Module $module) use ($collection) {
                if ($module->offsetExists('permissions')) {
                    $collection->put($module->identification(), $module->get('permissions'));
                }
            });
            $this->repository->initialize($collection);
        }

        return $this->repository;
    }
}
