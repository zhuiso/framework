<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Commands;

use Zs\Foundation\Image\Response;

/**
 * Class ResponseCommand.
 */
class ResponseCommand extends AbstractCommand
{
    /**
     * Builds HTTP response from given image.
     *
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function execute($image)
    {
        $format = $this->argument(0)->value();
        $quality = $this->argument(1)->between(0, 100)->value();
        $response = new Response($image, $format, $quality);
        $this->setOutput($response->make());

        return true;
    }
}
