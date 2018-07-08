<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image;

/**
 * Class Response.
 */
class Response
{
    /**
     * Image that should be displayed by response
     *
     * @var \Zs\Foundation\Image\Image
     */
    public $image;

    /**
     * Format of displayed image
     *
     * @var string
     */
    public $format;

    /**
     * Quality of displayed image
     *
     * @var int
     */
    public $quality;

    /**
     * Response constructor.
     *
     * @param \Zs\Foundation\Image\Image $image
     * @param null                           $format
     * @param null                           $quality
     */
    public function __construct(Image $image, $format = null, $quality = null)
    {
        $this->image = $image;
        $this->format = $format ? $format : $image->mime;
        $this->quality = $quality ? $quality : 90;
    }

    /**
     * Builds response according to settings
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function make()
    {
        $this->image->encode($this->format, $this->quality);
        $data = $this->image->getEncoded();
        $mime = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $data);
        $length = strlen($data);
        if (function_exists('app') && is_a($app = app(), 'Illuminate\Foundation\Application')) {
            $response = \Response::make($data);
            $response->header('Content-Type', $mime);
            $response->header('Content-Length', $length);
        } else {
            header('Content-Type: ' . $mime);
            header('Content-Length: ' . $length);
            $response = $data;
        }

        return $response;
    }
}
