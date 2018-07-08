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
 * Class LimitColorsCommand.
 */
class LimitColorsCommand extends AbstractCommand
{
    /**
     * Reduces colors of a given image.
     *
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $count = $this->argument(0)->value();
        $matte = $this->argument(1)->value();
        $size = $image->getSize();
        $resource = imagecreatetruecolor($size->width, $size->height);
        if (is_null($matte)) {
            $matte = imagecolorallocatealpha($resource, 255, 255, 255, 127);
        } else {
            $matte = $image->getDriver()->parseColor($matte)->getInt();
        }
        imagefill($resource, 0, 0, $matte);
        imagecolortransparent($resource, $matte);
        imagecopy($resource, $image->getCore(), 0, 0, 0, 0, $size->width, $size->height);
        if (is_numeric($count) && $count <= 256) {
            imagetruecolortopalette($resource, true, $count);
        }
        $image->setCore($resource);

        return true;
    }
}
