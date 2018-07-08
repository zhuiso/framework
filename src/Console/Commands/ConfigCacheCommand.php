<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;
use Illuminate\Filesystem\Filesystem;
use Zs\Foundation\Application;
use Zs\Foundation\Console\Kernel as ConsoleKernel;
use Zs\Foundation\Http\ExceptionHandler;
use Zs\Foundation\Http\Kernel;

/**
 * Class ConfigCacheCommand.
 */
class ConfigCacheCommand extends Command
{
    /**
     * @var string
     */
    protected $name = 'config:cache';

    /**
     * @var string
     */
    protected $description = 'Create a cache file for faster configuration loading';

    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * ConfigCacheCommand constructor.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Command handler.
     */
    public function handle()
    {
        $this->call('config:clear');
        $config = $this->getFreshConfiguration();
        $this->files->put($this->laravel->getCachedConfigPath(),
            '<?php return ' . var_export($config, true) . ';' . PHP_EOL);
        $this->info('Configuration cached successfully!');
    }

    /**
     * Boot a fresh copy of the application configuration.
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getFreshConfiguration()
    {
        $application = new Application($this->laravel->basePath());
        $application->singleton(HttpKernelContract::class, Kernel::class);
        $application->singleton(ConsoleKernelContract::class, ConsoleKernel::class);
        $application->singleton(ExceptionHandlerContract::class, ExceptionHandler::class);
        $application->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $application['config']->all();
    }
}
