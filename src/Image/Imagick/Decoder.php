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
use ImagickException;
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
        $core = new Imagick();
        try {
            $core->readImage($path);
            $core->setImageType(Imagick::IMGTYPE_TRUECOLOR);
        } catch (ImagickException $e) {
            throw new NotReadableException("Unable to read image from path ({$path}).", 0, $e);
        }
        $image = $this->initFromImagick($core);
        $image->setFileInfoFromPath($path);

        return $image;
    }

    /**
     * @param resource $resource
     *
     * @return \Zs\Foundation\Image\Image|void
     */
    public function initFromGdResource($resource)
    {
        throw new NotSupportedException('Imagick driver is unable to init from GD resource.');
    }

    /**
     * @param Imagick $object
     *
     * @return \Zs\Foundation\Image\Image
     */
    public function initFromImagick(Imagick $object)
    {
        $object = $this->removeAnimation($object);
        $object->setImageOrientation(Imagick::ORIENTATION_UNDEFINED);

        return new Image(new Driver(), $object);
    }

    /**
     * @param string $binary
     *
     * @return \Zs\Foundation\Image\Image
     */
    public function initFromBinary($binary)
    {
        $core = new Imagick();
        try {
            $core->readImageBlob($binary);
        } catch (ImagickException $e) {
            throw new NotReadableException('Unable to read image from binary data.', 0, $e);
        }
        $image = $this->initFromImagick($core);
        $image->mime = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $binary);

        return $image;
    }

    /**
     * @param Imagick $object
     *
     * @return Imagick
     */
    private function removeAnimation(Imagick $object)
    {
        $imagick = new Imagick();
        foreach ($object as $frame) {
            $imagick->addImage($frame->getImage());
            break;
        }
        $object->destroy();

        return $imagick;
    }
}
