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
use Zs\Foundation\Image\Exceptions\NotSupportedException;
use Zs\Foundation\Image\Gd\Color;
use Zs\Foundation\Image\Image;

/**
 * Class LineShape.
 */
class LineShape extends AbstractShape
{
    /**
     * @var int
     */
    public $x = 0;

    /**
     * @var int
     */
    public $y = 0;

    /**
     * @var string
     */
    public $color = '#000000';

    /**
     * @var int
     */
    public $width = 1;

    /**
     * @param int $x
     * @param int $y
     */
    public function __construct($x = null, $y = null)
    {
        $this->x = is_numeric($x) ? intval($x) : $this->x;
        $this->y = is_numeric($y) ? intval($y) : $this->y;
    }

    /**
     * @param string $color
     */
    public function color($color)
    {
        $this->color = $color;
    }

    /**
     * @param int $width
     */
    public function width($width)
    {
        throw new NotSupportedException('Line width is not supported by GD driver.');
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
        $color = new Color($this->color);
        imageline($image->getCore(), $x, $y, $this->x, $this->y, $color->getInt());

        return true;
    }
}
