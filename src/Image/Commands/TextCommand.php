<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------

namespace Zs\Foundation\Image\Commands;

use Closure;

/**
 * Class TextCommand.
 */
class TextCommand extends AbstractCommand
{
    /**
     * Write text on given image.
     *
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $text = $this->argument(0)->required()->value();
        $x = $this->argument(1)->type('numeric')->value(0);
        $y = $this->argument(2)->type('numeric')->value(0);
        $callback = $this->argument(3)->type('closure')->value();
        $fontclassname = sprintf('\Zs\Foundation\Image\%s\Font', $image->getDriver()->getDriverName());
        $font = new $fontclassname($text);
        if ($callback instanceof Closure) {
            $callback($font);
        }
        $font->applyToImage($image, $x, $y);

        return true;
    }
}
