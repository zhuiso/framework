<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Gd;

use Zs\Foundation\Image\AbstractEncoder;
use Zs\Foundation\Image\Exceptions\NotSupportedException;

/**
 * Class Encoder.
 */
class Encoder extends AbstractEncoder
{
    /**
     * Processes and returns encoded image as JPEG string.
     *
     * @return string
     */
    protected function processJpeg()
    {
        ob_start();
        imagejpeg($this->image->getCore(), null, $this->quality);
        $this->image->mime = image_type_to_mime_type(IMAGETYPE_JPEG);
        $buffer = ob_get_contents();
        ob_end_clean();

        return $buffer;
    }

    /**
     * @return string
     */
    protected function processPng()
    {
        ob_start();
        $resource = $this->image->getCore();
        imagealphablending($resource, false);
        imagesavealpha($resource, true);
        imagepng($resource, null, -1);
        $this->image->mime = image_type_to_mime_type(IMAGETYPE_PNG);
        $buffer = ob_get_contents();
        ob_end_clean();

        return $buffer;
    }

    /**
     * @return string
     */
    protected function processGif()
    {
        ob_start();
        imagegif($this->image->getCore());
        $this->image->mime = image_type_to_mime_type(IMAGETYPE_GIF);
        $buffer = ob_get_contents();
        ob_end_clean();

        return $buffer;
    }

    /**
     * @return string
     */
    protected function processTiff()
    {
        throw new NotSupportedException('TIFF format is not supported by Gd Driver.');
    }

    /**
     * @return string
     */
    protected function processBmp()
    {
        throw new NotSupportedException('BMP format is not supported by Gd Driver.');
    }

    /**
     * @return string
     */
    protected function processIco()
    {
        throw new NotSupportedException('ICO format is not supported by Gd Driver.');
    }

    /**
     * @return string
     */
    protected function processPsd()
    {
        throw new NotSupportedException('PSD format is not supported by Gd Driver.');
    }

    /**
     * @return string
     */
    protected function processWebp()
    {
        if (!function_exists('imagewebp')) {
            throw new NotSupportedException('Webp format is not supported by Gd Driver.');
        }
        ob_start();
        $result = imagewebp($this->image->getCore());
        $this->image->mime = 'image/webp';
        $buffer = ob_get_contents();
        ob_end_clean();

        return $buffer;
    }
}
