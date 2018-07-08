<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Imagick;

use Imagick;
use Zs\Foundation\Image\AbstractDriver;
use Zs\Foundation\Image\Exceptions\NotSupportedException;
use Zs\Foundation\Image\Image;

/**
 * Class Driver.
 */
class Driver extends AbstractDriver
{
    /**
     * @param \Zs\Foundation\Image\Imagick\Decoder|null $decoder
     * @param \Zs\Foundation\Image\Imagick\Encoder|null $encoder
     */
    public function __construct(Decoder $decoder = null, Encoder $encoder = null)
    {
        if (!$this->coreAvailable()) {
            throw new NotSupportedException('ImageMagick module not available with this PHP installation.');
        }
        $this->decoder = $decoder ? $decoder : new Decoder();
        $this->encoder = $encoder ? $encoder : new Encoder();
    }

    /**
     * @param int    $width
     * @param int    $height
     * @param string $background
     *
     * @return Image
     */
    public function newImage($width, $height, $background = null)
    {
        $background = new Color($background);
        $core = new Imagick();
        $core->newImage($width, $height, $background->getPixel(), 'png');
        $core->setType(Imagick::IMGTYPE_UNDEFINED);
        $core->setImageType(Imagick::IMGTYPE_UNDEFINED);
        $core->setColorspace(Imagick::COLORSPACE_UNDEFINED);
        $image = new Image(new static(), $core);

        return $image;
    }

    /**
     * @param string $value
     *
     * @return \Zs\Foundation\Image\AbstractColor
     */
    public function parseColor($value)
    {
        return new Color($value);
    }

    /**
     * @return bool
     */
    protected function coreAvailable()
    {
        return extension_loaded('imagick') && class_exists('Imagick');
    }
}
