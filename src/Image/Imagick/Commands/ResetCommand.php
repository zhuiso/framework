<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Imagick\Commands;

use Imagick;
use Zs\Foundation\Image\Commands\AbstractCommand;
use Zs\Foundation\Image\Exceptions\RuntimeException;

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
        $backup = $image->getBackup($backupName);
        if ($backup instanceof Imagick) {
            $image->getCore()->clear();
            $backup = clone $backup;
            $image->setCore($backup);

            return true;
        }
        throw new RuntimeException("Backup not available. Call backup({$backupName}) before reset().");
    }
}
