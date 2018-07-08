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
 * Class CircleCommand.
 */
class CircleCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $diameter = $this->argument(0)->type('numeric')->required()->value();
        $x = $this->argument(1)->type('numeric')->required()->value();
        $y = $this->argument(2)->type('numeric')->required()->value();
        $callback = $this->argument(3)->type('closure')->value();
        $circle_classname = sprintf('\Zs\Foundation\Image\%s\Shapes\CircleShape',
            $image->getDriver()->getDriverName());
        $circle = new $circle_classname($diameter);
        if ($callback instanceof Closure) {
            $callback($circle);
        }
        $circle->applyToImage($image, $x, $y);

        return true;
    }
}
