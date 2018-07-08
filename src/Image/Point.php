<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image;

/**
 * Class Point.
 */
class Point
{
    /**
     * X coordinate
     *
     * @var int
     */
    public $x;

    /**
     * Y coordinate
     *
     * @var int
     */
    public $y;

    /**
     * Point constructor.
     *
     * @param int $x
     * @param int $y
     */
    public function __construct($x = null, $y = null)
    {
        $this->x = is_numeric($x) ? intval($x) : 0;
        $this->y = is_numeric($y) ? intval($y) : 0;
    }

    /**
     * Sets X coordinate
     *
     * @param int $x
     */
    public function setX($x)
    {
        $this->x = intval($x);
    }

    /**
     * Sets Y coordinate
     *
     * @param int $y
     */
    public function setY($y)
    {
        $this->y = intval($y);
    }

    /**
     * Sets both X and Y coordinate
     *
     * @param int $x
     * @param int $y
     */
    public function setPosition($x, $y)
    {
        $this->setX($x);
        $this->setY($y);
    }
}
