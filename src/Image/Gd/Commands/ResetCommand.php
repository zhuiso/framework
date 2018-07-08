<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Gd\Commands;

use Zs\Foundation\Image\Commands\AbstractCommand;
use Zs\Foundation\Image\Exceptions\RuntimeException;

/**
 * Class ResetCommand.
 */
class ResetCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $backupName = $this->argument(0)->value();
        if (is_resource($backup = $image->getBackup($backupName))) {
            imagedestroy($image->getCore());
            $backup = $image->getDriver()->cloneCore($backup);
            $image->setCore($backup);

            return true;
        }
        throw new RuntimeException('Backup not available. Call backup() before reset().');
    }
}
