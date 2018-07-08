<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Extension\Commands;

use Zs\Foundation\Console\Abstracts\Command;
use Zs\Foundation\Extension\Abstracts\Installer;
use Zs\Foundation\Extension\Extension;

/**
 * Class InstallCommand.
 */
class InstallCommand extends Command
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setDescription('To install a extension by identification');
        $this->setName('extension:install');
    }

    /**
     * Command handler.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $extensions = $this->extension->repository()->filter(function (Extension $extension) {
            return $extension->get('require.install') == true;
        });
        $extensions->each(function (Extension $extension) {
            $installer = $extension->get('namespace') . 'Installer';
            if (class_exists($installer)) {
                $installer = new $installer;
                if ($installer instanceof Installer) {
                    $installer->handle();
                    $key = 'extension.' . $extension->identification() . '.installed';
                    $this->setting->set($key, true);
                    $key = 'extension.' . $extension->identification() . '.require.install';
                    $this->setting->set($key, false);
                }
            }
        });
        $this->cache->tags('zs')->flush();
        $this->info('已安装以下拓展：');
        $extensions->each(function (Extension $extension) {
            $this->info($extension->identification());
        });

        return true;
    }
}
