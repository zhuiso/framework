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
 * Class EllipseShape.
 */
class EllipseShape extends AbstractShape
{
    /**
     * @var int
     */
    public $width = 100;

    /**
     * @var int
     */
    public $height = 100;

    /**
     * @param int $width
     * @param int $height
     */
    public function __construct($width = null, $height = null)
    {
        $this->width = is_numeric($width) ? intval($width) : $this->width;
        $this->height = is_numeric($height) ? intval($height) : $this->height;
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
        if ($this->hasBorder()) {
            imagefilledellipse($image->getCore(), $x, $y, $this->width - 1, $this->height - 1, $background->getInt());
            $border_color = new Color($this->border_color);
            imagesetthickness($image->getCore(), $this->border_width);
            imagearc($image->getCore(), $x, $y, $this->width, $this->height, 0, 359.99, $border_color->getInt());
        } else {
            imagefilledellipse($image->getCore(), $x, $y, $this->width, $this->height, $background->getInt());
        }

        return true;
    }
}
