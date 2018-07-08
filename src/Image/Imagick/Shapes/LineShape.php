<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Imagick\Shapes;

use Zs\Foundation\Image\AbstractShape;
use Zs\Foundation\Image\Image;
use Zs\Foundation\Image\Imagick\Color;

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
     * LineShape constructor.
     *
     * @param null $x
     * @param null $y
     */
    public function __construct($x = null, $y = null)
    {
        $this->x = is_numeric($x) ? intval($x) : $this->x;
        $this->y = is_numeric($y) ? intval($y) : $this->y;
    }

    /**
     * @param $color
     */
    public function color($color)
    {
        $this->color = $color;
    }

    /**
     * @param $width
     */
    public function width($width)
    {
        $this->width = $width;
    }

    /**
     * @param \Zs\Foundation\Image\Image $image
     * @param int                            $x
     * @param int                            $y
     *
     * @return bool
     */
    public function applyToImage(Image $image, $x = 0, $y = 0)
    {
        $line = new \ImagickDraw();
        $color = new Color($this->color);
        $line->setStrokeColor($color->getPixel());
        $line->setStrokeWidth($this->width);
        $line->line($this->x, $this->y, $x, $y);
        $image->getCore()->drawImage($line);

        return true;
    }
}
