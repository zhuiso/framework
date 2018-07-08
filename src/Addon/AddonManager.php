<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Addon;

use Illuminate\Support\Collection;
use Zs\Foundation\Addon\Repositories\AddonRepository;
use Zs\Foundation\Addon\Repositories\AssetsRepository;
use Zs\Foundation\Addon\Repositories\NavigationRepository;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class ExtensionManager.
 */
class AddonManager
{
    use Helpers;

    /**
     * @var \Zs\Foundation\Addon\Repositories\AssetsRepository
     */
    protected $assetsRepository;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $excepts;

    /**
     * @var \Zs\Foundation\Addon\Repositories\NavigationRepository
     */
    protected $navigationRepository;

    /**
     * @var \Zs\Foundation\Addon\Repositories\AddonRepository
     */
    protected $repository;

    /**
     * AddonManager constructor.
     */
    public function __construct()
    {
        $this->excepts = collect();
    }

    /**
     * Get a extension by name.
     *
     * @param $name
     *
     * @return \Zs\Foundation\Addon\Addon
     */
    public function get($name): Addon
    {
        return $this->repository()->get($name);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function enabled(): Collection
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
     * @return \Zs\Foundation\Addon\Repositories\NavigationRepository
     */
    public function navigations()
    {
        if (!$this->navigationRepository instanceof NavigationRepository) {
            $collection = $this->enabled()->map(function (Addon $addon) {
                return $addon->offsetExists('navigations') ? (array)$addon->get('navigations') : [];
            });
            $this->navigationRepository = new NavigationRepository();
            $this->navigationRepository->initialize($collection);
        }
        return $this->navigationRepository;
    }

    /**
     * @return \Zs\Foundation\Addon\Repositories\AddonRepository
     */
    public function repository(): AddonRepository
    {
        if (!$this->repository instanceof AddonRepository) {
            $collection = collect();
            if ($this->container->isInstalled()) {
                collect($this->file->directories($this->getExtensionPath()))->each(function ($vendor) use ($collection) {
                    collect($this->file->directories($vendor))->each(function ($directory) use ($collection) {
                        $collection->push($directory);
                    });
                });
            }
            $this->repository = new AddonRepository();
            $this->repository->initialize($collection);
        }

        return $this->repository;
    }

    /**
     * Path for extension.
     *
     * @return string
     */
    public function getExtensionPath(): string
    {
        return $this->container->addonPath();
    }

    /**
     * Check for extension exist.
     *
     * @param $name
     *
     * @return bool
     */
    public function has($name): bool
    {
        return $this->repository()->has($name);
    }

    /**
     * @return \Zs\Foundation\Addon\Repositories\AssetsRepository
     */
    public function assets()
    {
        if (!$this->assetsRepository instanceof AssetsRepository) {
            $collection = collect();
            $this->repository->enabled()->each(function (Addon $addon) use ($collection) {
                $collection->put($addon->identification(), $addon->get('assets', []));
            });
            $this->assetsRepository = new AssetsRepository();
            $this->assetsRepository->initialize($collection);
        }

        return $this->assetsRepository;
    }

    /**
     * Vendor Path.
     *
     * @return string
     */
    public function getVendorPath(): string
    {
        return $this->container->basePath() . DIRECTORY_SEPARATOR . 'vendor';
    }

    /**
     * @return array
     */
    public function getExcepts()
    {
        return $this->excepts->toArray();
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
