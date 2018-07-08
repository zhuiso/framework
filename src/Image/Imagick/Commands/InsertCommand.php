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
 * Class InsertCommand.
 */
class InsertCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $source = $this->argument(0)->required()->value();
        $position = $this->argument(1)->type('string')->value();
        $x = $this->argument(2)->type('digit')->value(0);
        $y = $this->argument(3)->type('digit')->value(0);
        $watermark = $image->getDriver()->init($source);
        $image_size = $image->getSize()->align($position, $x, $y);
        $watermark_size = $watermark->getSize()->align($position);
        $target = $image_size->relativePosition($watermark_size);

        return $image->getCore()->compositeImage($watermark->getCore(), \Imagick::COMPOSITE_DEFAULT, $target->x,
            $target->y);
    }
}
