<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Imagick\Shapes;

use ImagickDraw;
use Zs\Foundation\Image\AbstractShape;
use Zs\Foundation\Image\Image;
use Zs\Foundation\Image\Imagick\Color;

/**
 * Class PolygonShape.
 */
class PolygonShape extends AbstractShape
{
    /**
     * @var array
     */
    public $points;

    /**
     * PolygonShape constructor.
     *
     * @param $points
     */
    public function __construct($points)
    {
        $this->points = $this->formatPoints($points);
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
        $polygon = new ImagickDraw();
        $bgcolor = new Color($this->background);
        $polygon->setFillColor($bgcolor->getPixel());
        if ($this->hasBorder()) {
            $border_color = new Color($this->border_color);
            $polygon->setStrokeWidth($this->border_width);
            $polygon->setStrokeColor($border_color->getPixel());
        }
        $polygon->polygon($this->points);
        $image->getCore()->drawImage($polygon);

        return true;
    }

    /**
     * @param $points
     *
     * @return array
     */
    private function formatPoints($points)
    {
        $ipoints = [];
        $count = 1;
        foreach ($points as $key => $value) {
            if ($count % 2 === 0) {
                $y = $value;
                $ipoints[] = [
                    'x' => $x,
                    'y' => $y,
                ];
            } else {
                $x = $value;
            }
            ++$count;
        }

        return $ipoints;
    }
}
