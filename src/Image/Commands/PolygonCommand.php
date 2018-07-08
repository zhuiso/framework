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
use Zs\Foundation\Image\Exceptions\InvalidArgumentException;

/**
 * Class PolygonCommand.
 */
class PolygonCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $points = $this->argument(0)->type('array')->required()->value();
        $callback = $this->argument(1)->type('closure')->value();
        $vertices_count = count($points);
        // check if number if coordinates is even
        if ($vertices_count % 2 !== 0) {
            throw new InvalidArgumentException('The number of given polygon vertices must be even.');
        }
        if ($vertices_count < 6) {
            throw new InvalidArgumentException('You must have at least 3 points in your array.');
        }
        $polygon_classname = sprintf('\Zs\Foundation\Image\%s\Shapes\PolygonShape',
            $image->getDriver()->getDriverName());
        $polygon = new $polygon_classname($points);
        if ($callback instanceof Closure) {
            $callback($polygon);
        }
        $polygon->applyToImage($image);

        return true;
    }
}
