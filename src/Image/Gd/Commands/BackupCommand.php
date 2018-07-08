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

/**
 * Class BackupCommand.
 */
class BackupCommand extends AbstractCommand
{
    /**
     * Saves a backups of current state of image core.
     *
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $backupName = $this->argument(0)->value();
        $size = $image->getSize();
        $clone = imagecreatetruecolor($size->width, $size->height);
        imagealphablending($clone, false);
        imagesavealpha($clone, true);
        $transparency = imagecolorallocatealpha($clone, 0, 0, 0, 127);
        imagefill($clone, 0, 0, $transparency);
        imagecopy($clone, $image->getCore(), 0, 0, 0, 0, $size->width, $size->height);
        $image->setBackup($clone, $backupName);

        return true;
    }
}
