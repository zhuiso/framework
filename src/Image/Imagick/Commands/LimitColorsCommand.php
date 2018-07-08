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

/**
 * Class LimitColorsCommand.
 */
class LimitColorsCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $count = $this->argument(0)->value();
        $matte = $this->argument(1)->value();
        $size = $image->getSize();
        $alpha = clone $image->getCore();
        $alpha->separateImageChannel(Imagick::CHANNEL_ALPHA);
        $alpha->transparentPaintImage('#ffffff', 0, 0, false);
        $alpha->separateImageChannel(Imagick::CHANNEL_ALPHA);
        $alpha->negateImage(false);
        if ($matte) {
            $mattecolor = $image->getDriver()->parseColor($matte)->getPixel();
            $canvas = new Imagick();
            $canvas->newImage($size->width, $size->height, $mattecolor, 'png');
            $image->getCore()->quantizeImage($count, Imagick::COLORSPACE_RGB, 0, false, false);
            $canvas->compositeImage($image->getCore(), Imagick::COMPOSITE_DEFAULT, 0, 0);
            $canvas->compositeImage($alpha, Imagick::COMPOSITE_COPYOPACITY, 0, 0);
            $image->setCore($canvas);
        } else {
            $image->getCore()->quantizeImage($count, Imagick::COLORSPACE_RGB, 0, false, false);
            $image->getCore()->compositeImage($alpha, Imagick::COMPOSITE_COPYOPACITY, 0, 0);
        }

        return true;
    }
}
