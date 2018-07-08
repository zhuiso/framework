<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------

namespace Zs\Foundation\Addon\Handlers;

use Closure;
use Illuminate\Container\Container;
use Illuminate\Contracts\Console\Kernel;
use Zs\Foundation\Addon\AddonManager;
use Zs\Foundation\Routing\Abstracts\Handler;
use Zs\Foundation\Setting\Contracts\SettingsRepository;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

/**
 * Class UninstallHandler.
 */
class UninstallHandler extends Handler
{
    /**
     * @var \Zs\Foundation\Addon\AddonManager
     */
    protected $manager;

    /**
     * @var \Zs\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    /**
     * UninstallHandler constructor.
     *
     * @param \Illuminate\Container\Container                         $container
     * @param \Zs\Foundation\Addon\AddonManager                   $manager
     * @param \Zs\Foundation\Setting\Contracts\SettingsRepository $settings
     */
    public function __construct(Container $container, AddonManager $manager, SettingsRepository $settings)
    {
        parent::__construct($container);
        $this->manager = $manager;
        $this->settings = $settings;
    }

    /**
     * Execute Handler.
     */
    public function execute()
    {
        set_time_limit(0);
        $extension = $this->manager->get($this->request->input('identification'));
        $output = new BufferedOutput();
        $result = false;
        if ($extension) {
            $collection = collect();
            // Has Migrations.
            $extension->offsetExists('migrations') && $collection->put('migrations', $extension->get('migrations'));
            if (method_exists($provider = $extension->provider(), 'uninstall') && $closure = call_user_func([
                    $provider,
                    'uninstall',
                ])) {
                if ($closure instanceof Closure && $this->settings->get('extension.' . $extension->identification() . '.installed', false) && $closure()) {
                    if ($collection->count() && $collection->every(function ($instance, $key) use ($extension, $output) {
                            switch ($key) {
                                case 'migrations':
                                    if (is_array($instance) && collect($instance)->every(function ($path) use ($extension, $output) {
                                            $path = $extension->get('directory') . DIRECTORY_SEPARATOR . $path;
                                            $migration = str_replace($this->container->basePath(), '', $path);
                                            $migration = trim($migration, DIRECTORY_SEPARATOR);
                                            $input = new ArrayInput([
                                                '--path' => $migration,
                                                '--force' => true,
                                            ]);
                                            $this->getConsole()->find('migrate:rollback')->run($input, $output);

                                            return true;
                                        })) {
                                        return true;
                                    } else {
                                        return false;
                                    }
                                    break;
                                default:
                                    return false;
                                    break;
                            }
                        })) {
                        $result = true;
                    }
                }
            }
        }
        if ($result) {
            $this->container->make('log')->info('Uninstall Module ' . $this->request->input('identification') . ':', explode(PHP_EOL, $output->fetch()));
            $this->settings->set('extension.' . $extension->identification() . '.installed', false);
            $this->withCode(200)->withMessage('卸载插件[' . $extension->identification() . ']成功！');
        } else {
            $this->withCode(500)->withError('卸载插件失败！');
        }
    }

    /**
     * Get console instance.
     *
     * @return \Illuminate\Contracts\Console\Kernel|\Zs\Foundation\Console\Application
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getConsole()
    {
        $kernel = $this->container->make(Kernel::class);
        $kernel->bootstrap();

        return $kernel->getArtisan();
    }
}
