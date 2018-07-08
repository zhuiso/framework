<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Filters;

use Zs\Foundation\Image\Image;

/**
 * Class DemoFilter.
 */
class DemoFilter implements FilterInterface
{
    const DEFAULT_SIZE = 10;

    /**
     * @var int
     */
    private $size;

    /**
     * @param int $size
     */
    public function __construct($size = null)
    {
        $this->size = is_numeric($size) ? intval($size) : self::DEFAULT_SIZE;
    }

    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return \Zs\Foundation\Image\Image
     */
    public function applyFilter(Image $image)
    {
        $image->pixelate($this->size);
        $image->greyscale();

        return $image;
    }
}
