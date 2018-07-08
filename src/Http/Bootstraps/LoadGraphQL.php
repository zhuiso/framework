<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Bootstraps;

use Zs\Foundation\Arr;
use Zs\Foundation\Http\Contracts\Bootstrap;
use Zs\Foundation\Module\Module;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class LoadGraphQL.
 */
class LoadGraphQL implements Bootstrap
{
    use Helpers;

    /**
     * Bootstrap the given application.
     */
    public function bootstrap()
    {
        $directories = [];
        if ($this->container->isInstalled()) {
            $directories = array_merge($directories, $this->module->enabled()->map(function (Module $module) {
                return [
                    'directory' => $module->directory() . DIRECTORY_SEPARATOR . 'src',
                    'namespace' => $module->namespace(),
                ];
            })->values()->toArray());
        }
        $mutations = [];
        $queries = [];
        $types = [];
        foreach ($directories as $definitions) {
            list($directory, $namespace) = array_values($definitions);
            $graphql = realpath($directory . DIRECTORY_SEPARATOR . 'GraphQL');
            if ($this->file->isDirectory($graphql)) {
                $namespace = $namespace . $this->file->name($directory) . '\\GraphQL';
                $mutation = $graphql . DIRECTORY_SEPARATOR . 'Mutations';
                $this->file->isDirectory($mutation) && $mutations = $this->load($mutation, $mutations, 'Mutations', $namespace);
                $query = $graphql . DIRECTORY_SEPARATOR . 'Queries';
                $this->file->isDirectory($query) && $queries = $this->load($query, $queries, 'Queries', $namespace);
                $type = $graphql . DIRECTORY_SEPARATOR . 'Types';
                $this->file->isDirectory($type) && $types = $this->load($type, $types, 'Types', $namespace);
            }
        }
        Arr::each(function ($type) {
            $this->graphql->addType($type);
        }, $types);
    }

    /**
     * @param string $directory
     * @param array  $exists
     * @param string $folder
     * @param string $namespace
     *
     * @return array
     */
    protected function load(string $directory, array $exists, string $folder, string $namespace)
    {
        return array_merge($exists, array_filter(Arr::map(function ($file) use ($folder, $namespace) {
            $class = $namespace . '\\' . $folder . '\\' . $this->file->name($file);
            if ($this->file->extension($file) == 'php' && class_exists($class)) {
                return $class;
            } else {
                return false;
            }
        }, $this->file->files($directory))));
    }
}
