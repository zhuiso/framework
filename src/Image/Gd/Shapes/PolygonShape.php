<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Gd\Shapes;

use Zs\Foundation\Image\AbstractShape;
use Zs\Foundation\Image\Gd\Color;
use Zs\Foundation\Image\Image;

/**
 * Class PolygonShape.
 */
class PolygonShape extends AbstractShape
{
    /**
     * @var int
     */
    public $points;

    /**
     * @param array $points
     */
    public function __construct($points)
    {
        $this->points = $points;
    }

    /**
     * @param Image $image
     * @param int   $x
     * @param int   $y
     *
     * @return bool
     */
    public function applyToImage(Image $image, $x = 0, $y = 0)
    {
        $background = new Color($this->background);
        imagefilledpolygon($image->getCore(), $this->points, intval(count($this->points) / 2), $background->getInt());
        if ($this->hasBorder()) {
            $border_color = new Color($this->border_color);
            imagesetthickness($image->getCore(), $this->border_width);
            imagepolygon($image->getCore(), $this->points, intval(count($this->points) / 2), $border_color->getInt());
        }

        return true;
    }
}
