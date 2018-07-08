<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Commands;

use Closure;

/**
 * Class EllipseCommand.
 */
class EllipseCommand extends AbstractCommand
{
    /**
     * Draws ellipse on given image.
     *
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $width = $this->argument(0)->type('numeric')->required()->value();
        $height = $this->argument(1)->type('numeric')->required()->value();
        $x = $this->argument(2)->type('numeric')->required()->value();
        $y = $this->argument(3)->type('numeric')->required()->value();
        $callback = $this->argument(4)->type('closure')->value();
        $ellipse_classname = sprintf('\Zs\Foundation\Image\%s\Shapes\EllipseShape',
            $image->getDriver()->getDriverName());
        $ellipse = new $ellipse_classname($width, $height);
        if ($callback instanceof Closure) {
            $callback($ellipse);
        }
        $ellipse->applyToImage($image, $x, $y);

        return true;
    }
}
