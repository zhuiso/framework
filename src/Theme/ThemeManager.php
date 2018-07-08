<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Theme;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class ThemeManager.
 */
class ThemeManager
{
    use Helpers;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $themes;

    /**
     * ThemeManager constructor.
     */
    public function __construct()
    {
        $this->themes = new Collection();
    }

    /**
     * Themes of installed or not installed.
     *
     * @param bool $installed
     *
     * @return \Illuminate\Support\Collection
     */
    public function getThemes($installed = false)
    {
        if ($this->themes->isEmpty()) {
            if ($this->file->isDirectory($this->getThemePath()) && !empty($directories = $this->file->directories($this->getThemePath()))) {
                (new Collection($directories))->each(function ($directory) use ($installed) {
                    if ($this->file->exists($file = $directory . DIRECTORY_SEPARATOR . 'composer.json')) {
                        $package = new Collection(json_decode($this->file->get($file), true));
                        if (Arr::get($package, 'type') == 'zs-extension' && $name = Arr::get($package, 'name')) {
                            $module = new Theme($name, Arr::get($package, 'authors'),
                                Arr::get($package, 'description'));
                            if ($installed) {
                                $module->setInstalled($installed);
                            }
                            $this->themes->put($directory, $module);
                        }
                    }
                });
            }
        }
        return $this->themes;
    }

    /**
     * @return string
     */
    public function getThemePath()
    {
        return $this->container->basePath() . DIRECTORY_SEPARATOR . 'themes';
    }
}
