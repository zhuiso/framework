<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Commands;

use GuzzleHttp\Psr7\Response;

/**
 * Class PsrResponseCommand.
 */
class PsrResponseCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $format = $this->argument(0)->value();
        $quality = $this->argument(1)->between(0, 100)->value();
        $stream = $image->stream($format, $quality);
        $mimetype = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $image->getEncoded());
        $this->setOutput(new Response(200, [
            'Content-Type'   => $mimetype,
            'Content-Length' => strlen($image->getEncoded()),
        ], $stream));

        return true;
    }
}
