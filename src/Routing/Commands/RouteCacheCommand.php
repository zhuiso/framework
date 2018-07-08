<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Routing\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Routing\RouteCollection;
use Zs\Foundation\Application;
use Zs\Foundation\Console\Kernel as ConsoleKernel;
use Zs\Foundation\Http\ExceptionHandler;
use Zs\Foundation\Http\Kernel;

/**
 * Class RouteCacheCommand.
 */
class RouteCacheCommand extends Command
{
    /**
     * @var string
     */
    protected $name = 'route:cache';

    /**
     * @var string
     */
    protected $description = 'Create a route cache file for faster route registration';

    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * RouteCacheCommand constructor.
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
     *
     * @return bool
     * @throws \Exception
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $this->call('route:clear');
        $routes = $this->getFreshApplicationRoutes();
        if (count($routes) == 0) {
            $this->error("Your application doesn't have any routes.");

            return false;
        }
        foreach ($routes as $route) {
            $route->prepareForSerialization();
        }
        $this->files->put($this->laravel->getCachedRoutesPath(), $this->buildRouteCacheFile($routes));
        $this->info('Routes cached successfully!');

        return true;
    }

    /**
     * Fresh application routes.
     *
     * @return \Illuminate\Routing\RouteCollection
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getFreshApplicationRoutes()
    {
        $application = new Application($this->laravel->basePath());
        $application->singleton(HttpKernelContract::class, Kernel::class);
        $application->singleton(ConsoleKernelContract::class, ConsoleKernel::class);
        $application->singleton(ExceptionHandlerContract::class, ExceptionHandler::class);
        $application->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $application['router']->getRoutes();
    }

    /**
     * Build route cache file.
     *
     * @param \Illuminate\Routing\RouteCollection $routes
     *
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildRouteCacheFile(RouteCollection $routes)
    {
        $stub = $this->files->get($this->getStub());
        $stub = str_replace('DummyDatetime', Carbon::now()->toDateTimeString(), $stub);

        return str_replace('{{routes}}', base64_encode(serialize($routes)), $stub);
    }

    /**
     * Get stub file.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../../../stubs/routes/caches.stub';
    }
}
