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
 * Class ColorizeCommand.
 */
class ColorizeCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $red = $this->argument(0)->between(-100, 100)->required()->value();
        $green = $this->argument(1)->between(-100, 100)->required()->value();
        $blue = $this->argument(2)->between(-100, 100)->required()->value();
        $red = $this->normalizeLevel($red);
        $green = $this->normalizeLevel($green);
        $blue = $this->normalizeLevel($blue);
        $qrange = $image->getCore()->getQuantumRange();
        $image->getCore()->levelImage(0, $red, $qrange['quantumRangeLong'], \Imagick::CHANNEL_RED);
        $image->getCore()->levelImage(0, $green, $qrange['quantumRangeLong'], \Imagick::CHANNEL_GREEN);
        $image->getCore()->levelImage(0, $blue, $qrange['quantumRangeLong'], \Imagick::CHANNEL_BLUE);

        return true;
    }

    /**
     * @param $level
     *
     * @return float
     */
    private function normalizeLevel($level)
    {
        if ($level > 0) {
            return $level / 5;
        } else {
            return ($level + 100) / 100;
        }
    }
}
