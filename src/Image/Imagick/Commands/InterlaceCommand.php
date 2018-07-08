<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Imagick\Commands;

use Imagick;
use Zs\Foundation\Image\Commands\AbstractCommand;

/**
 * Class InterlaceCommand.
 */
class InterlaceCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $mode = $this->argument(0)->type('bool')->value(true);
        if ($mode) {
            $mode = Imagick::INTERLACE_LINE;
        } else {
            $mode = Imagick::INTERLACE_NO;
        }
        $image->getCore()->setInterlaceScheme($mode);

        return true;
    }
}
