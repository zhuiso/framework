<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Module;

use Illuminate\Support\Collection;
use Zs\Foundation\Module\Repositories\AssetsRepository;
use Zs\Foundation\Module\Repositories\MenuRepository;
use Zs\Foundation\Module\Repositories\ModuleRepository;
use Zs\Foundation\Module\Repositories\PageRepository;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class ModuleManager.
 */
class ModuleManager
{
    use Helpers;

    /**
     * @var \Zs\Foundation\Module\Repositories\AssetsRepository
     */
    protected $assetsRepository;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $excepts;

    /**
     * @var \Zs\Foundation\Module\Repositories\MenuRepository
     */
    protected $menuRepository;

    /**
     * @var \Zs\Foundation\Module\Repositories\PageRepository
     */
    protected $pageRepository;

    /**
     * @var \Zs\Foundation\Module\Repositories\ModuleRepository
     */
    protected $repository;

    /**
     * ModuleManager constructor.
     */
    public function __construct()
    {
        $this->excepts = collect();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function enabled()
    {
        return $this->repository()->enabled();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function installed(): Collection
    {
        return $this->repository()->installed();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function notInstalled(): Collection
    {
        return $this->repository()->notInstalled();
    }

    /**
     * @return \Zs\Foundation\Module\Repositories\ModuleRepository
     */
    public function repository(): ModuleRepository
    {
        if (!$this->repository instanceof ModuleRepository) {
            $this->repository = new ModuleRepository();
            $this->repository->initialize(collect($this->file->directories($this->getModulePath())));
        }

        return $this->repository;
    }

    /**
     * Get a module by name.
     *
     * @param $name
     *
     * @return \Zs\Foundation\Module\Module
     */
    public function get($name): Module
    {
        return $this->repository->get($name);
    }

    /**
     * Module path.
     *
     * @return string
     */
    public function getModulePath(): string
    {
        return $this->container->modulePath();
    }

    /**
     * Check for module exist.
     *
     * @param $name
     *
     * @return bool
     */
    public function has($name): bool
    {
        return $this->repository->has($name);
    }

    /**
     * @return array
     */
    public function getExcepts()
    {
        return $this->excepts->toArray();
    }

    /**
     * @return \Zs\Foundation\Module\Repositories\MenuRepository
     */
    public function menus(): MenuRepository
    {
        if (!$this->menuRepository instanceof MenuRepository) {
            $collection = collect();
            $this->repository->enabled()->each(function (Module $module) use ($collection) {
                $collection->put($module->identification(), $module->get('menus', []));
            });
            $this->menuRepository = new MenuRepository();
            $this->menuRepository->initialize($collection);
        }

        return $this->menuRepository;
    }

    /**
     * @return \Zs\Foundation\Module\Repositories\PageRepository
     */
    public function pages(): PageRepository
    {
        if (!$this->pageRepository instanceof PageRepository) {
            $collection = collect();
            $this->repository->enabled()->each(function (Module $module) use ($collection) {
                $collection->put($module->identification(), $module->get('pages', []));
            });
            $this->pageRepository = new PageRepository();
            $this->pageRepository->initialize($collection);
        }

        return $this->pageRepository;
    }

    /**
     * @return \Zs\Foundation\Module\Repositories\AssetsRepository
     */
    public function assets(): AssetsRepository
    {
        if (!$this->assetsRepository instanceof AssetsRepository) {
            $collection = collect();
            $this->repository->enabled()->each(function (Module $module) use ($collection) {
                $collection->put($module->identification(), $module->get('assets', []));
            });
            $this->assetsRepository = new AssetsRepository();
            $this->assetsRepository->initialize($collection);
        }

        return $this->assetsRepository;
    }

    /**
     * @param $excepts
     */
    public function registerExcept($excepts)
    {
        foreach ((array)$excepts as $except) {
            $this->excepts->push($except);
        }
    }
}
