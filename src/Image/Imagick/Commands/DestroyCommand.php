<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Imagick\Commands;

use Zs\Foundation\Image\Commands\AbstractCommand;

/**
 * Class DestroyCommand.
 */
class DestroyCommand extends AbstractCommand
{
    /**
     * Destroys current image core and frees up memory.
     *
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $image->getCore()->clear();
        foreach ($image->getBackups() as $backup) {
            $backup->clear();
        }

        return true;
    }
}
