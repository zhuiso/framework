<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image;

use Imagick;
use Zs\Foundation\Image\Exceptions\NotReadableException;

/**
 * Class AbstractDecoder.
 */
abstract class AbstractDecoder
{
    /**
     * Initiates new image from path in filesystem
     *
     * @param string $path
     *
     * @return \Zs\Foundation\Image\Image
     */
    abstract public function initFromPath($path);

    /**
     * Initiates new image from binary data
     *
     * @param string $data
     *
     * @return \Zs\Foundation\Image\Image
     */
    abstract public function initFromBinary($data);

    /**
     * Initiates new image from GD resource
     *
     * @param resource $resource
     *
     * @return \Zs\Foundation\Image\Image
     */
    abstract public function initFromGdResource($resource);

    /**
     * Initiates new image from Imagick object
     *
     * @param \Imagick $object
     *
     * @return \Zs\Foundation\Image\Image
     */
    abstract public function initFromImagick(Imagick $object);

    /**
     * Buffer of input data
     *
     * @var mixed
     */
    private $data;

    /**
     * AbstractDecoder constructor.
     *
     * @param mixed $data
     */
    public function __construct($data = null)
    {
        $this->data = $data;
    }

    /**
     * Init from fiven URL
     *
     * @param string $url
     *
     * @return \Zs\Foundation\Image\Image
     * @throws \Zs\Foundation\Image\Exceptions\NotReadableException
     */
    public function initFromUrl($url)
    {
        if ($data = @file_get_contents($url)) {
            return $this->initFromBinary($data);
        }
        throw new NotReadableException('Unable to init from given url (' . $url . ').');
    }

    /**
     * Init from given stream
     *
     * @param $stream
     *
     * @return \Zs\Foundation\Image\Image
     * @throws \Zs\Foundation\Image\Exceptions\NotReadableException
     */
    public function initFromStream($stream)
    {
        $offset = ftell($stream);
        rewind($stream);
        $data = @stream_get_contents($stream);
        fseek($stream, $offset);
        if ($data) {
            return $this->initFromBinary($data);
        }
        throw new NotReadableException('Unable to init from given stream');
    }

    /**
     * Determines if current source data is GD resource
     *
     * @return bool
     */
    public function isGdResource()
    {
        if (is_resource($this->data)) {
            return get_resource_type($this->data) == 'gd';
        }

        return false;
    }

    /**
     * Determines if current source data is Imagick object
     *
     * @return bool
     */
    public function isImagick()
    {
        return is_a($this->data, 'Imagick');
    }

    /**
     * Determines if current source data is Zs\Foundation\Image\Image object
     *
     * @return bool
     */
    public function isZsImage()
    {
        return is_a($this->data, '\Zs\Foundation\Image\Image');
    }

    /**
     * Determines if current data is SplFileInfo object
     *
     * @return bool
     */
    public function isSplFileInfo()
    {
        return is_a($this->data, 'SplFileInfo');
    }

    /**
     * Determines if current data is Symfony UploadedFile component
     *
     * @return bool
     */
    public function isSymfonyUpload()
    {
        return is_a($this->data, 'Symfony\Component\HttpFoundation\File\UploadedFile');
    }

    /**
     * Determines if current source data is file path
     *
     * @return bool
     */
    public function isFilePath()
    {
        if (is_string($this->data)) {
            return is_file($this->data);
        }

        return false;
    }

    /**
     * Determines if current source data is url
     *
     * @return bool
     */
    public function isUrl()
    {
        return (bool)filter_var($this->data, FILTER_VALIDATE_URL);
    }

    /**
     * Determines if current source data is a stream resource
     *
     * @return bool
     */
    public function isStream()
    {
        if (!is_resource($this->data)) {
            return false;
        }
        if (get_resource_type($this->data) !== 'stream') {
            return false;
        }

        return true;
    }

    /**
     * Determines if current source data is binary data
     *
     * @return bool
     */
    public function isBinary()
    {
        if (is_string($this->data)) {
            $mime = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $this->data);

            return substr($mime, 0, 4) != 'text' && $mime != 'application/x-empty';
        }

        return false;
    }

    /**
     * Determines if current source data is data-url
     *
     * @return bool
     */
    public function isDataUrl()
    {
        $data = $this->decodeDataUrl($this->data);

        return is_null($data) ? false : true;
    }

    /**
     * Determines if current source data is base64 encoded
     *
     * @return bool
     */
    public function isBase64()
    {
        if (!is_string($this->data)) {
            return false;
        }

        return base64_encode(base64_decode($this->data)) === $this->data;
    }

    /**
     * Initiates new Image from Intervention\Image\Image
     *
     * @param Image $object
     * @return \Zs\Foundation\Image\Image
     */
    public function initFromZsImage($object)
    {
        return $object;
    }

    /**
     * Parses and decodes binary image data from data-url
     *
     * @param string $data_url
     *
     * @return string
     */
    private function decodeDataUrl($data_url)
    {
        if (!is_string($data_url)) {
            return null;
        }
        $pattern = "/^data:(?:image\/[a-zA-Z\-\.]+)(?:charset=\".+\")?;base64,(?P<data>.+)$/";
        preg_match($pattern, $data_url, $matches);
        if (is_array($matches) && array_key_exists('data', $matches)) {
            return base64_decode($matches['data']);
        }

        return null;
    }

    /**
     * Initiates new image from mixed data
     *
     * @param mixed $data
     *
     * @return \Zs\Foundation\Image\Image
     * @throws \Zs\Foundation\Image\Exceptions\NotReadableException
     */
    public function init($data)
    {
        $this->data = $data;
        switch (true) {
            case $this->isGdResource():
                return $this->initFromGdResource($this->data);
            case $this->isImagick():
                return $this->initFromImagick($this->data);
            case $this->isZsImage():
                return $this->initFromZsImage($this->data);
            case $this->isSplFileInfo():
                return $this->initFromPath($this->data->getRealPath());
            case $this->isBinary():
                return $this->initFromBinary($this->data);
            case $this->isUrl():
                return $this->initFromUrl($this->data);
            case $this->isStream():
                return $this->initFromStream($this->data);
            case $this->isFilePath():
                return $this->initFromPath($this->data);
            case $this->isDataUrl():
                return $this->initFromBinary($this->decodeDataUrl($this->data));
            case $this->isBase64():
                return $this->initFromBinary(base64_decode($this->data));
            default:
                throw new NotReadableException('Image source not readable');
        }
    }

    /**
     * Decoder object transforms to string source data
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->data;
    }
}
