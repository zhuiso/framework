<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Extension;

use Zs\Foundation\Extension\Repositories\ExtensionRepository;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class ExtensionManager.
 */
class ExtensionManager
{
    use Helpers;

    /**
     * @var \Zs\Foundation\Extension\Repositories\ExtensionRepository
     */
    protected $repository;

    /**
     * @param $identification
     *
     * @return bool
     */
    public function has($identification)
    {
        return $this->repository()->has($identification);
    }

    /**
     * @return \Zs\Foundation\Extension\Repositories\ExtensionRepository
     */
    public function repository()
    {
        if (!$this->repository instanceof ExtensionRepository) {
            $this->repository = new ExtensionRepository();
            $this->repository->initialize(collect($this->file->directories($this->getExtensionPath())));
        }

        return $this->repository;
    }

    /**
     * @return string
     */
    protected function getExtensionPath(): string
    {
        return $this->container->extensionPath();
    }
}
