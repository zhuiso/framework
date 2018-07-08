<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Imagick\Commands;

use ImagickDraw;
use Zs\Foundation\Image\Commands\AbstractCommand;
use Zs\Foundation\Image\Imagick\Color;

/**
 * Class PixelCommand.
 */
class PixelCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $color = $this->argument(0)->required()->value();
        $color = new Color($color);
        $x = $this->argument(1)->type('digit')->required()->value();
        $y = $this->argument(2)->type('digit')->required()->value();
        $draw = new ImagickDraw();
        $draw->setFillColor($color->getPixel());
        $draw->point($x, $y);

        return $image->getCore()->drawImage($draw);
    }
}
