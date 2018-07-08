<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Imagick\Commands;

use Zs\Foundation\Image\Commands\AbstractCommand;

/**
 * Class FlipCommand.
 */
class FlipCommand extends AbstractCommand
{
    /**
     * Mirrors an image.
     *
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $mode = $this->argument(0)->value('h');
        if (in_array(strtolower($mode), [
            2,
            'v',
            'vert',
            'vertical',
        ])) {
            return $image->getCore()->flipImage();
        } else {
            return $image->getCore()->flopImage();
        }
    }
}
