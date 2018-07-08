<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Detectors;

use Illuminate\Console\Application as Artisan;
use Zs\Foundation\Addon\Addon;
use Zs\Foundation\Http\Contracts\Detector;
use Zs\Foundation\Module\Module;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class CommandDetector.
 */
class CommandDetector implements Detector
{
    use Helpers;

    /**
     * Detect paths.
     *
     * @param string $path
     * @param string $namespace
     *
     * @return array
     */
    public function detect(string $path, string $namespace)
    {
        $collection = collect();
        collect($this->file->files($path))->each(function ($file) use ($collection, $namespace) {
            $class = '';
            $this->file->extension($file) == 'php' && $class = $namespace . '\\' . $this->file->name($file);
            class_exists($class) && $collection->push($class);
        });

        return $collection->toArray();
    }

    /**
     * Do.
     *
     * @param $target
     */
    public function do($target)
    {
        Artisan::starting(function (Artisan $artisan) use ($target) {
            $artisan->resolve($target);
        });
    }

    /**
     * Paths definition.
     *
     * @return array
     */
    public function paths()
    {
        $collection = collect();
        if ($this->container->isInstalled()) {
            $this->module->enabled()->each(function (Module $module) use ($collection) {
                $location = realpath($module->get('directory') . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Commands');
                $this->file->isDirectory($location) && $collection->push([
                    'namespace' => $module->get('namespace') . 'Commands',
                    'path'      => $location,
                ]);
            });
            $this->addon->enabled()->each(function (Addon $extension) use ($collection) {
                $location = realpath($extension->get('directory') . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Commands');
                $this->file->isDirectory($location) && $collection->push([
                    'namespace' => $extension->get('namespace') . 'Commands',
                    'path'      => $location,
                ]);
            });
        }

        return $collection->toArray();
    }
}
