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
use Zs\Foundation\Image\AbstractEncoder;

/**
 * Class Encoder.
 */
class Encoder extends AbstractEncoder
{
    /**
     * @return string
     */
    protected function processJpeg()
    {
        $format = 'jpeg';
        $compression = Imagick::COMPRESSION_JPEG;
        $imagick = $this->image->getCore();
        $imagick->setImageBackgroundColor('white');
        $imagick->setBackgroundColor('white');
        $imagick = $imagick->mergeImageLayers(Imagick::LAYERMETHOD_MERGE);
        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);
        $imagick->setCompressionQuality($this->quality);
        $imagick->setImageCompressionQuality($this->quality);

        return $imagick->getImagesBlob();
    }

    /**
     * @return string
     */
    protected function processPng()
    {
        $format = 'png';
        $compression = Imagick::COMPRESSION_ZIP;
        $imagick = $this->image->getCore();
        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);

        return $imagick->getImagesBlob();
    }

    /**
     * @return string
     */
    protected function processGif()
    {
        $format = 'gif';
        $compression = Imagick::COMPRESSION_LZW;
        $imagick = $this->image->getCore();
        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);

        return $imagick->getImagesBlob();
    }

    /**
     * @return string
     */
    protected function processTiff()
    {
        $format = 'tiff';
        $compression = Imagick::COMPRESSION_UNDEFINED;
        $imagick = $this->image->getCore();
        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);
        $imagick->setCompressionQuality($this->quality);
        $imagick->setImageCompressionQuality($this->quality);

        return $imagick->getImagesBlob();
    }

    /**
     * @return string
     */
    protected function processBmp()
    {
        $format = 'bmp';
        $compression = Imagick::COMPRESSION_UNDEFINED;
        $imagick = $this->image->getCore();
        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);

        return $imagick->getImagesBlob();
    }

    /**
     * @return string
     */
    protected function processIco()
    {
        $format = 'ico';
        $compression = Imagick::COMPRESSION_UNDEFINED;
        $imagick = $this->image->getCore();
        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);

        return $imagick->getImagesBlob();
    }

    /**
     * @return string
     */
    protected function processPsd()
    {
        $format = 'psd';
        $compression = Imagick::COMPRESSION_UNDEFINED;
        $imagick = $this->image->getCore();
        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);

        return $imagick->getImagesBlob();
    }

    /**
     * @return string
     */
    protected function processWebp()
    {
        $format = 'webp';
        $compression = Imagick::COMPRESSION_UNDEFINED;
        $imagick = $this->image->getCore();
        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);
        $imagick->setImageCompressionQuality($this->quality);

        return $imagick->getImagesBlob();
    }
}
