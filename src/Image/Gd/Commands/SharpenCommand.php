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

/**
 * Class SharpenCommand.
 */
class SharpenCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $amount = $this->argument(0)->between(0, 100)->value(10);
        $min = $amount >= 10 ? $amount * -0.01 : 0;
        $max = $amount * -0.025;
        $abs = ((4 * $min + 4 * $max) * -1) + 1;
        $div = 1;
        $matrix = [
            [
                $min,
                $max,
                $min,
            ],
            [
                $max,
                $abs,
                $max,
            ],
            [
                $min,
                $max,
                $min,
            ],
        ];

        return imageconvolution($image->getCore(), $matrix, $div, 0);
    }
}
