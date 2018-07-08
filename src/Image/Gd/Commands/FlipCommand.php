<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Gd\Commands;

/**
 * Class FlipCommand.
 */
class FlipCommand extends ResizeCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $mode = $this->argument(0)->value('h');
        $size = $image->getSize();
        $dst = clone $size;
        switch (strtolower($mode)) {
            case 2:
            case 'v':
            case 'vert':
            case 'vertical':
                $size->pivot->y = $size->height - 1;
                $size->height = $size->height * (-1);
                break;
            default:
                $size->pivot->x = $size->width - 1;
                $size->width = $size->width * (-1);
                break;
        }

        return $this->modify($image, 0, 0, $size->pivot->x, $size->pivot->y, $dst->width, $dst->height, $size->width,
            $size->height);
    }
}
