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
use Zs\Foundation\Image\Imagick\Color;

/**
 * Class RotateCommand.
 */
class RotateCommand extends AbstractCommand
{
    /**
     * Rotates image counter clockwise.
     *
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $angle = $this->argument(0)->type('numeric')->required()->value();
        $color = $this->argument(1)->value();
        $color = new Color($color);
        $image->getCore()->rotateImage($color->getPixel(), ($angle * -1));

        return true;
    }
}
