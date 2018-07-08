<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Gd;

use Zs\Foundation\Image\AbstractColor;
use Zs\Foundation\Image\Exceptions\NotSupportedException;

/**
 * Class Color.
 */
class Color extends AbstractColor
{
    /**
     * @var int
     */
    public $r;

    /**
     * @var int
     */
    public $g;

    /**
     * @var int
     */
    public $b;

    /**
     * @var float
     */
    public $a;

    /**
     * @param int $value
     *
     * @return \Zs\Foundation\Image\AbstractColor|void
     */
    public function initFromInteger($value)
    {
        $this->a = ($value >> 24) & 0xFF;
        $this->r = ($value >> 16) & 0xFF;
        $this->g = ($value >> 8) & 0xFF;
        $this->b = $value & 0xFF;
    }

    /**
     * @param array $array
     *
     * @return \Zs\Foundation\Image\AbstractColor|void
     */
    public function initFromArray($array)
    {
        $array = array_values($array);
        if (count($array) == 4) {
            list($r, $g, $b, $a) = $array;
            $this->a = $this->alpha2gd($a);
        } elseif (count($array) == 3) {
            list($r, $g, $b) = $array;
            $this->a = 0;
        }
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
    }

    /**
     * @param string $value
     *
     * @return \Zs\Foundation\Image\AbstractColor|void
     */
    public function initFromString($value)
    {
        if ($color = $this->rgbaFromString($value)) {
            $this->r = $color[0];
            $this->g = $color[1];
            $this->b = $color[2];
            $this->a = $this->alpha2gd($color[3]);
        }
    }

    /**
     * @param int $r
     * @param int $g
     * @param int $b
     *
     * @return \Zs\Foundation\Image\AbstractColor|void
     */
    public function initFromRgb($r, $g, $b)
    {
        $this->r = intval($r);
        $this->g = intval($g);
        $this->b = intval($b);
        $this->a = 0;
    }

    /**
     * @param int $r
     * @param int $g
     * @param int $b
     * @param int $a
     *
     * @return \Zs\Foundation\Image\AbstractColor|void
     */
    public function initFromRgba($r, $g, $b, $a = 1)
    {
        $this->r = intval($r);
        $this->g = intval($g);
        $this->b = intval($b);
        $this->a = $this->alpha2gd($a);
    }

    /**
     * @param \ImagickPixel $value
     *
     * @return \Zs\Foundation\Image\AbstractColor|void
     */
    public function initFromObject($value)
    {
        throw new NotSupportedException('GD colors cannot init from ImagickPixel objects.');
    }

    /**
     * @return int
     */
    public function getInt()
    {
        return ($this->a << 24) + ($this->r << 16) + ($this->g << 8) + $this->b;
    }

    /**
     * @param string $prefix
     *
     * @return string
     */
    public function getHex($prefix = '')
    {
        return sprintf('%s%02x%02x%02x', $prefix, $this->r, $this->g, $this->b);
    }

    /**
     * @return array
     */
    public function getArray()
    {
        return [
            $this->r,
            $this->g,
            $this->b,
            round(1 - $this->a / 127, 2),
        ];
    }

    /**
     * @return string
     */
    public function getRgba()
    {
        return sprintf('rgba(%d, %d, %d, %.2f)', $this->r, $this->g, $this->b, round(1 - $this->a / 127, 2));
    }

    /**
     * @param \Zs\Foundation\Image\AbstractColor $color
     * @param int                                    $tolerance
     *
     * @return bool
     */
    public function differs(AbstractColor $color, $tolerance = 0)
    {
        $color_tolerance = round($tolerance * 2.55);
        $alpha_tolerance = round($tolerance * 1.27);
        $delta = [
            'r' => abs($color->r - $this->r),
            'g' => abs($color->g - $this->g),
            'b' => abs($color->b - $this->b),
            'a' => abs($color->a - $this->a),
        ];

        return $delta['r'] > $color_tolerance or $delta['g'] > $color_tolerance or $delta['b'] > $color_tolerance or $delta['a'] > $alpha_tolerance;
    }

    /**
     * @param $input
     *
     * @return float
     */
    private function alpha2gd($input)
    {
        $oldMin = 0;
        $oldMax = 1;
        $newMin = 127;
        $newMax = 0;

        return ceil(((($input - $oldMin) * ($newMax - $newMin)) / ($oldMax - $oldMin)) + $newMin);
    }
}
