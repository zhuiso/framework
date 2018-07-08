<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Gd\Commands;

use Zs\Foundation\Image\Size;

/**
 * Class FitCommand.
 */
class FitCommand extends ResizeCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $width = $this->argument(0)->type('digit')->required()->value();
        $height = $this->argument(1)->type('digit')->value($width);
        $constraints = $this->argument(2)->type('closure')->value();
        $position = $this->argument(3)->type('string')->value('center');
        $cropped = $image->getSize()->fit(new Size($width, $height), $position);
        $resized = clone $cropped;
        $resized = $resized->resize($width, $height, $constraints);
        $this->modify($image, 0, 0, $cropped->pivot->x, $cropped->pivot->y, $resized->getWidth(), $resized->getHeight(),
            $cropped->getWidth(), $cropped->getHeight());

        return true;
    }
}
