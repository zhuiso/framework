<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Gd\Commands;

use Zs\Foundation\Image\Commands\AbstractCommand;
use Zs\Foundation\Image\Gd\Color;

/**
 * Class PickColorCommand.
 */
class PickColorCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $x = $this->argument(0)->type('digit')->required()->value();
        $y = $this->argument(1)->type('digit')->required()->value();
        $format = $this->argument(2)->type('string')->value('array');
        $color = imagecolorat($image->getCore(), $x, $y);
        if (!imageistruecolor($image->getCore())) {
            $color = imagecolorsforindex($image->getCore(), $color);
            $color['alpha'] = round(1 - $color['alpha'] / 127, 2);
        }
        $color = new Color($color);
        $this->setOutput($color->format($format));

        return true;
    }
}
