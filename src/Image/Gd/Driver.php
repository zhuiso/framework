<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Gd;

use Zs\Foundation\Image\AbstractColor;
use Zs\Foundation\Image\AbstractDriver;
use Zs\Foundation\Image\Exceptions\NotSupportedException;
use Zs\Foundation\Image\Image;

/**
 * Class Driver.
 */
class Driver extends AbstractDriver
{
    /**
     * @param Decoder $decoder
     * @param Encoder $encoder
     */
    public function __construct(Decoder $decoder = null, Encoder $encoder = null)
    {
        if (!$this->coreAvailable()) {
            throw new NotSupportedException('GD Library extension not available with this PHP installation.');
        }
        $this->decoder = $decoder ? $decoder : new Decoder();
        $this->encoder = $encoder ? $encoder : new Encoder();
    }

    /**
     * Creates new image instance.
     *
     * @param int    $width
     * @param int    $height
     * @param string $background
     *
     * @return \Zs\Foundation\Image\Image
     */
    public function newImage($width, $height, $background = null)
    {
        // create empty resource
        $core = imagecreatetruecolor($width, $height);
        $image = new Image(new static(), $core);
        // set background color
        $background = new Color($background);
        imagefill($image->getCore(), 0, 0, $background->getInt());

        return $image;
    }

    /**
     * @param string $value
     *
     * @return AbstractColor
     */
    public function parseColor($value)
    {
        return new Color($value);
    }

    /**
     * Checks if core module installation is available.
     *
     * @return bool
     */
    protected function coreAvailable()
    {
        return extension_loaded('gd') && function_exists('gd_info');
    }

    /**
     * Returns clone of given core.
     *
     * @return mixed
     */
    public function cloneCore($core)
    {
        $width = imagesx($core);
        $height = imagesy($core);
        $clone = imagecreatetruecolor($width, $height);
        imagealphablending($clone, false);
        imagesavealpha($clone, true);
        imagecopy($clone, $core, 0, 0, 0, 0, $width, $height);

        return $clone;
    }
}
