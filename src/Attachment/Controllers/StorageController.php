<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Attachment\Controllers;

use Zs\Foundation\Attachment\Handlers\StorageSetHandler;
use Zs\Foundation\Routing\Abstracts\Controller;

/**
 * Class StorageController.
 */
class StorageController extends Controller
{
    /**
     * Api handler.
     *
     * @param \Zs\Foundation\Attachment\Handlers\StorageSetHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse
     * @throws \Exception
     */
    public function handle(StorageSetHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
}
