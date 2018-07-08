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
 * Interface FilterInterface.
 */
interface FilterInterface
{
    /**\
     * @param  \Zs\Foundation\Image\Image $image
     *
     * @return \Zs\Foundation\Image\Image
     */
    public function applyFilter(Image $image);
}
