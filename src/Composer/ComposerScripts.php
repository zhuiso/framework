<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Composer;

use Composer\Script\Event;
use Zs\Foundation\Application;

/**
 * Class ComposerScripts.
 */
class ComposerScripts
{
    /**
     * Post Install Handler for composer install.
     *
     * @param \Composer\Script\Event $event
     *
     * @return void
     */
    public static function postInstall(Event $event)
    {
        require_once $event->getComposer()->getConfig()->get('vendor-dir') . '/autoload.php';
        static::clearCompiled();
    }

    /**
     * Post Update Handler for composer update.
     *
     * @param \Composer\Script\Event $event
     *
     * @return void
     */
    public static function postUpdate(Event $event)
    {
        require_once $event->getComposer()->getConfig()->get('vendor-dir') . '/autoload.php';
        static::clearCompiled();
    }

    /**
     * Clear the cached Laravel bootstrapping files.
     *
     * @return void
     */
    protected static function clearCompiled()
    {
        $zs = new Application(getcwd());
        if (file_exists($servicesPath = $zs->getCachedServicesPath())) {
            @unlink($servicesPath);
        }
    }
}
