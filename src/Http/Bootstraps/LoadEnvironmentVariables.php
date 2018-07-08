<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Bootstraps;

use Zs\Foundation\Application;
use Zs\Foundation\Http\Contracts\Bootstrap;
use Zs\Foundation\Routing\Traits\Helpers;
use Zs\Foundation\Yaml\Exceptions\InvalidPathException;
use Zs\Foundation\Yaml\YamlEnv;
use Symfony\Component\Console\Input\ArgvInput;

/**
 * Class DetectEnvironment.
 */
class LoadEnvironmentVariables implements Bootstrap
{
    use Helpers;

    /**
     * Bootstrap the given application.
     */
    public function bootstrap()
    {
        $this->container->singleton('yaml.environment', function () {
            return new YamlEnv($this->container->environmentPath(), $this->container->environmentFile());
        });
        if (!$this->container->configurationIsCached()) {
            $this->checkForSpecificEnvironmentFile($this->container);
            try {
                $this->container->make('yaml.environment')->load();
            } catch (InvalidPathException $e) {
            }
        }
        $this->container->detectEnvironment(function () {
            return env('APP_ENV', 'production');
        });
    }

    /**
     * Detect if a custom environment file matching the APP_ENV exists.
     *
     * @param \Illuminate\Contracts\Foundation\Application|\Zs\Foundation\Application $app
     */
    protected function checkForSpecificEnvironmentFile($app)
    {
        if (php_sapi_name() == 'cli') {
            $input = new ArgvInput();
            if ($input->hasParameterOption('--env')) {
                $file = $app->environmentFile() . '.' . $input->getParameterOption('--env');
                $this->loadEnvironmentFile($app, $file);
            }
        }
        if (!env('APP_ENV')) {
            return;
        }
        if (empty($file)) {
            $file = $app->environmentFile() . '.' . env('APP_ENV');
            $this->loadEnvironmentFile($app, $file);
        }
    }

    /**
     * Load a custom environment file.
     *
     * @param \Illuminate\Contracts\Foundation\Application|\Zs\Foundation\Application $app
     * @param string                                                                      $file
     */
    protected function loadEnvironmentFile($app, $file)
    {
        if (file_exists($app->environmentPath() . '/' . $file)) {
            $app->loadEnvironmentFrom($file);
        }
    }
}
