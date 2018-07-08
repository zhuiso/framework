<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Bootstraps;

use Illuminate\Log\Writer;
use Monolog\Logger as Monolog;
use Zs\Foundation\Application;
use Zs\Foundation\Http\Contracts\Bootstrap;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class ConfigureLogging.
 */
class ConfigureLogging implements Bootstrap
{
    use Helpers;

    /**
     * Bootstrap the given application.
     */
    public function bootstrap()
    {
        $log = $this->registerLogger($this->container);
        if ($this->container->hasMonologConfigurator()) {
            call_user_func($this->container->getMonologConfigurator(), $log->getMonolog());
        } else {
            $this->configureHandlers($this->container, $log);
        }
    }

    /**
     * Register the logger instance in the container.
     *
     * @param \Zs\Foundation\Application $app
     *
     * @return \Illuminate\Log\Writer
     */
    protected function registerLogger(Application $app)
    {
        $app->instance('log', $log = new Writer(new Monolog($app->environment()), $app['events']));

        return $log;
    }

    /**
     * Configure the Monolog handlers for the application.
     *
     * @param \Zs\Foundation\Application $app
     * @param \Illuminate\Log\Writer         $log
     */
    protected function configureHandlers(Application $app, Writer $log)
    {
        $method = 'configure' . ucfirst($app['config']['app.log']) . 'Handler';
        $this->{$method}($app, $log);
    }

    /**
     * Configure the Monolog handlers for the application.
     *
     * @param \Illuminate\Contracts\Foundation\Application|\Zs\Foundation\Application $app
     * @param \Illuminate\Log\Writer                                                      $log
     */
    protected function configureSingleHandler(Application $app, Writer $log)
    {
        $log->useFiles($app->storagePath() . '/logs/zs.log', $app->make('config')->get('app.log_level', 'debug'));
    }

    /**
     * Configure the Monolog handlers for the application.
     *
     * @param \Illuminate\Contracts\Foundation\Application|\Zs\Foundation\Application $app
     * @param \Illuminate\Log\Writer                                                      $log
     */
    protected function configureDailyHandler(Application $app, Writer $log)
    {
        $config = $app->make('config');
        $maxFiles = $config->get('app.log_max_files');
        $log->useDailyFiles($app->storagePath() . '/logs/zs.log', is_null($maxFiles) ? 5 : $maxFiles,
            $config->get('app.log_level', 'debug'));
    }

    /**
     * Configure the Monolog handlers for the application.
     *
     * @param \Illuminate\Contracts\Foundation\Application|\Zs\Foundation\Application $app
     * @param \Illuminate\Log\Writer                                                      $log
     */
    protected function configureSyslogHandler(Application $app, Writer $log)
    {
        $log->useSyslog('zs', $app->make('config')->get('app.log_level', 'debug'));
    }

    /**
     * Configure the Monolog handlers for the application.
     *
     * @param \Illuminate\Contracts\Foundation\Application|\Zs\Foundation\Application $app
     * @param \Illuminate\Log\Writer                                                      $log
     */
    protected function configureErrorlogHandler(Application $app, Writer $log)
    {
        $log->useErrorLog($app->make('config')->get('app.log_level', 'debug'));
    }
}
