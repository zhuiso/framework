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
 * Class OpacityCommand.
 */
class OpacityCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $transparency = $this->argument(0)->between(0, 100)->required()->value();
        $size = $image->getSize();
        $mask_color = sprintf('rgba(0, 0, 0, %.1f)', $transparency / 100);
        $mask = $image->getDriver()->newImage($size->width, $size->height, $mask_color);
        $image->mask($mask->getCore(), true);

        return true;
    }
}
