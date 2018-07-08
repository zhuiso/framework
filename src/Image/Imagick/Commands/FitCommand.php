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
 * Class FitCommand.
 */
class FitCommand extends AbstractCommand
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
        $image->getCore()->cropImage($cropped->width, $cropped->height, $cropped->pivot->x, $cropped->pivot->y);
        $image->getCore()->scaleImage($resized->getWidth(), $resized->getHeight());
        $image->getCore()->setImagePage(0, 0, 0, 0);

        return true;
    }
}
