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
 * Class ResizeCommand.
 */
class ResizeCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $width = $this->argument(0)->value();
        $height = $this->argument(1)->value();
        $constraints = $this->argument(2)->type('closure')->value();
        $resized = $image->getSize()->resize($width, $height, $constraints);
        $this->modify($image, 0, 0, 0, 0, $resized->getWidth(), $resized->getHeight(), $image->getWidth(),
            $image->getHeight());

        return true;
    }

    /**
     * @param \Zs\Foundation\Image\Image $image
     * @param int                            $dst_x
     * @param int                            $dst_y
     * @param int                            $src_x
     * @param int                            $src_y
     * @param int                            $dst_w
     * @param int                            $dst_h
     * @param int                            $src_w
     * @param int                            $src_h
     *
     * @return bool
     */
    protected function modify($image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h)
    {
        $modified = imagecreatetruecolor($dst_w, $dst_h);
        $resource = $image->getCore();
        $transIndex = imagecolortransparent($resource);
        if ($transIndex != -1) {
            $rgba = imagecolorsforindex($modified, $transIndex);
            $transColor = imagecolorallocatealpha($modified, $rgba['red'], $rgba['green'], $rgba['blue'], 127);
            imagefill($modified, 0, 0, $transColor);
            imagecolortransparent($modified, $transColor);
        } else {
            imagealphablending($modified, false);
            imagesavealpha($modified, true);
        }
        $result = imagecopyresampled($modified, $resource, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w,
            $src_h);
        $image->setCore($modified);

        return $result;
    }
}
