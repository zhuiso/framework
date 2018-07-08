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
 * Class TrimCommand.
 */
class TrimCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $base = $this->argument(0)->type('string')->value();
        $away = $this->argument(1)->value();
        $tolerance = $this->argument(2)->type('numeric')->value(0);
        $feather = $this->argument(3)->type('numeric')->value(0);
        $width = $image->getWidth();
        $height = $image->getHeight();
        $checkTransparency = false;
        if (is_null($away)) {
            $away = [
                'top',
                'right',
                'bottom',
                'left',
            ];
        } elseif (is_string($away)) {
            $away = [$away];
        }
        foreach ($away as $key => $value) {
            $away[$key] = strtolower($value);
        }
        switch (strtolower($base)) {
            case 'transparent':
            case 'trans':
                $checkTransparency = true;
                $base_x = 0;
                $base_y = 0;
                break;
            case 'bottom-right':
            case 'right-bottom':
                $base_x = $width - 1;
                $base_y = $height - 1;
                break;
            default:
            case 'top-left':
            case 'left-top':
                $base_x = 0;
                $base_y = 0;
                break;
        }
        if ($checkTransparency) {
            $base_color = new Color(); // color will only be used to compare alpha channel
        } else {
            $base_color = $image->pickColor($base_x, $base_y, 'object');
        }
        $trimed = clone $image->getCore();
        $trimed->borderImage($base_color->getPixel(), 1, 1);
        $trimed->trimImage(65850 / 100 * $tolerance);
        $imagePage = $trimed->getImagePage();
        list($crop_x, $crop_y) = [
            $imagePage['x'] - 1,
            $imagePage['y'] - 1,
        ];
        list($crop_width, $crop_height) = [
            $trimed->width,
            $trimed->height,
        ];
        if (!in_array('right', $away)) {
            $crop_width = $crop_width + ($width - ($width - $crop_x));
        }
        if (!in_array('bottom', $away)) {
            $crop_height = $crop_height + ($height - ($height - $crop_y));
        }
        if (!in_array('left', $away)) {
            $crop_width = $crop_width + $crop_x;
            $crop_x = 0;
        }
        if (!in_array('top', $away)) {
            $crop_height = $crop_height + $crop_y;
            $crop_y = 0;
        }
        $crop_width = min($width, ($crop_width + $feather * 2));
        $crop_height = min($height, ($crop_height + $feather * 2));
        $crop_x = max(0, ($crop_x - $feather));
        $crop_y = max(0, ($crop_y - $feather));
        $image->getCore()->cropImage($crop_width, $crop_height, $crop_x, $crop_y);
        $image->getCore()->setImagePage(0, 0, 0, 0);
        $trimed->destroy();

        return true;
    }
}
