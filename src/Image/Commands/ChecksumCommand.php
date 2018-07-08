<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Commands;

/**
 * Class ChecksumCommand.
 */
class ChecksumCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $colors = [];
        $size = $image->getSize();
        for ($x = 0; $x <= ($size->width - 1); ++$x) {
            for ($y = 0; $y <= ($size->height - 1); ++$y) {
                $colors[] = $image->pickColor($x, $y, 'array');
            }
        }
        $this->setOutput(md5(serialize($colors)));

        return true;
    }
}
