<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Gd;

use Imagick;
use Zs\Foundation\Image\AbstractDecoder;
use Zs\Foundation\Image\Exceptions\NotReadableException;
use Zs\Foundation\Image\Exceptions\NotSupportedException;
use Zs\Foundation\Image\Image;

/**
 * Class Decoder.
 */
class Decoder extends AbstractDecoder
{
    /**
     * @param string $path
     *
     * @return \Zs\Foundation\Image\Image
     */
    public function initFromPath($path)
    {
        $info = @getimagesize($path);
        if ($info === false) {
            throw new NotReadableException("Unable to read image from file ({$path}).");
        }
        switch ($info[2]) {
            case IMAGETYPE_PNG:
                $core = @imagecreatefrompng($path);
                break;
            case IMAGETYPE_JPEG:
                $core = @imagecreatefromjpeg($path);
                break;
            case IMAGETYPE_GIF:
                $core = @imagecreatefromgif($path);
                break;
            default:
                throw new NotReadableException('Unable to read image type. GD driver is only able to decode JPG, PNG or GIF files.');
        }
        if ($core === false) {
            throw new NotReadableException("Unable to read image from file ({$path}).");
        }
        $this->gdResourceToTruecolor($core);
        $image = $this->initFromGdResource($core);
        $image->mime = $info['mime'];
        $image->setFileInfoFromPath($path);

        return $image;
    }

    /**
     * @param resource $resource
     *
     * @return \Zs\Foundation\Image\Image
     */
    public function initFromGdResource($resource)
    {
        return new Image(new Driver(), $resource);
    }

    /**
     * @param Imagick $object
     *
     * @return \Zs\Foundation\Image\Image|void
     */
    public function initFromImagick(Imagick $object)
    {
        throw new NotSupportedException('Gd driver is unable to init from Imagick object.');
    }

    /**
     * @param string $binary
     *
     * @return \Zs\Foundation\Image\Image
     */
    public function initFromBinary($binary)
    {
        $resource = @imagecreatefromstring($binary);
        if ($resource === false) {
            throw new NotReadableException('Unable to init from given binary data.');
        }
        $image = $this->initFromGdResource($resource);
        $image->mime = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $binary);

        return $image;
    }

    /**
     * @param $resource
     *
     * @return bool
     */
    public function gdResourceToTruecolor(&$resource)
    {
        $width = imagesx($resource);
        $height = imagesy($resource);
        $canvas = imagecreatetruecolor($width, $height);
        imagealphablending($canvas, false);
        $transparent = imagecolorallocatealpha($canvas, 255, 255, 255, 127);
        imagefilledrectangle($canvas, 0, 0, $width, $height, $transparent);
        imagecolortransparent($canvas, $transparent);
        imagealphablending($canvas, true);
        imagecopy($canvas, $resource, 0, 0, 0, 0, $width, $height);
        imagedestroy($resource);
        $resource = $canvas;

        return true;
    }
}
