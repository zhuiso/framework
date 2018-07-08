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
use Zs\Foundation\Extension\Abstracts\Uninstaller;
use Zs\Foundation\Extension\Extension;

/**
 * Class UninstallCommand.
 */
class UninstallCommand extends Command
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setDescription('To uninstall a extension by identification');
        $this->setName('extension:uninstall');
    }

    /**
     * Command handler.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $extensions = $this->extension->repository()->filter(function (Extension $extension) {
            return $extension->get('require.uninstall') == true;
        });
        $extensions->each(function (Extension $extension) {
            $uninstaller = $extension->get('namespace') . 'Uninstaller';
            if (class_exists($uninstaller)) {
                $uninstaller = new $uninstaller;
                if ($uninstaller instanceof Uninstaller) {
                    $uninstaller->handle();
                    $key = 'extension.' . $extension->identification() . '.installed';
                    $this->setting->set($key, false);
                    $key = 'extension.' . $extension->identification() . '.require.uninstall';
                    $this->setting->set($key, false);
                }
            }
        });
        $this->cache->tags('zs')->flush();
        $this->info('已卸载以下拓展：');
        $extensions->each(function (Extension $extension) {
            $this->info($extension->identification());
        });

        return true;
    }
}