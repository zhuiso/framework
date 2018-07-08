<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Detectors;

use Zs\Foundation\Addon\Addon;
use Zs\Foundation\Http\Contracts\Detector;
use Zs\Foundation\Module\Module;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class SubscriberDetector.
 */
class SubscriberDetector implements Detector
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
        $classes = collect();
        collect($this->file->files($path))->each(function ($file) use ($classes, $namespace) {
            $class = '';
            $this->file->extension($file) == 'php' && $class = $namespace . '\\' . $this->file->name($file);
            class_exists($class) && $classes->push($class);
        });

        return $classes->toArray();
    }

    /**
     * Do.
     *
     * @param $target
     */
    public function do($target)
    {
        $this->event->subscribe($target);
    }

    /**
     * Paths definition.
     *
     * @return array
     */
    public function paths()
    {
        $paths = collect();
        $directories = $this->container->frameworkPath('src');
        collect($this->file->directories($directories))->each(function ($directory) use ($paths) {
            $location = realpath($directory . DIRECTORY_SEPARATOR . 'Subscribers');
            $this->file->isDirectory($location) && $paths->push([
                'namespace' => '\\Zs\\Foundation\\' . $this->file->name($directory) . '\\Subscribers',
                'path'      => $location,
            ]);
        });
        if ($this->container->isInstalled()) {
            $this->module->enabled()->each(function (Module $module) use ($paths) {
                $location = realpath(implode(DIRECTORY_SEPARATOR, [
                    $module->directory(),
                    'src',
                    'Subscribers',
                ]));
                $this->file->isDirectory($location) && $paths->push([
                    'namespace' => $module->get('namespace') . 'Subscribers',
                    'path'      => $location,
                ]);
            });
            $this->addon->enabled()->each(function (Addon $addon) use ($paths) {
                $location = realpath(implode(DIRECTORY_SEPARATOR, [
                    $addon->get('directory'),
                    'src',
                    'Subscribers',
                ]));
                $this->file->isDirectory($location) && $paths->push([
                    'namespace' => $addon->get('namespace') . 'Subscribers',
                    'path'      => $location,
                ]);
            });
        }

        return $paths->toArray();
    }
}
