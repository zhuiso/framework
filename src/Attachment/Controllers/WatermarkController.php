<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Attachment\Controllers;

use Zs\Foundation\Attachment\Handlers\WatermarkSetHandler;
use Zs\Foundation\Routing\Abstracts\Controller;

/**
 * Class WatermarkController.
 */
class WatermarkController extends Controller
{
    /**
     * Api handler.
     *
     * @param \Zs\Foundation\Attachment\Handlers\WatermarkSetHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse
     * @throws \Exception
     */
    public function handle(WatermarkSetHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
}
