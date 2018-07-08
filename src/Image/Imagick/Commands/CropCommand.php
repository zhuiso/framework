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
use Zs\Foundation\Image\Exceptions\InvalidArgumentException;
use Zs\Foundation\Image\Point;
use Zs\Foundation\Image\Size;

/**
 * Class CropCommand.
 */
class CropCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $width = $this->argument(0)->type('digit')->required()->value();
        $height = $this->argument(1)->type('digit')->required()->value();
        $x = $this->argument(2)->type('digit')->value();
        $y = $this->argument(3)->type('digit')->value();
        if (is_null($width) || is_null($height)) {
            throw new InvalidArgumentException('Width and height of cutout needs to be defined.');
        }
        $cropped = new Size($width, $height);
        $position = new Point($x, $y);
        if (is_null($x) && is_null($y)) {
            $position = $image->getSize()->align('center')->relativePosition($cropped->align('center'));
        }
        $image->getCore()->cropImage($cropped->width, $cropped->height, $position->x, $position->y);
        $image->getCore()->setImagePage(0, 0, 0, 0);

        return true;
    }
}
