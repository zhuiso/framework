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
 * Class ColorizeCommand.
 */
class ColorizeCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $red = $this->argument(0)->between(-100, 100)->required()->value();
        $green = $this->argument(1)->between(-100, 100)->required()->value();
        $blue = $this->argument(2)->between(-100, 100)->required()->value();
        $red = round($red * 2.55);
        $green = round($green * 2.55);
        $blue = round($blue * 2.55);

        return imagefilter($image->getCore(), IMG_FILTER_COLORIZE, $red, $green, $blue);
    }
}
