<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Setting\Controllers;

use Zs\Foundation\Routing\Abstracts\Controller;
use Zs\Foundation\Setting\Handlers\AllHandler;
use Zs\Foundation\Setting\Handlers\HandlerHandler;

/**
 * Class SettingController.
 */
class SettingController extends Controller
{
    /**
     * @var array
     */
    protected $permissions = [
        'global::global::global::setting.set' => 'set',
    ];

    /**
     * All handler.
     *
     * @param \Zs\Foundation\Setting\Handlers\AllHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse
     * @throws \Exception
     */
    public function all(AllHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * Set handler.
     *
     * @param \Zs\Foundation\Setting\Handlers\HandlerHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse
     * @throws \Exception
     */
    public function handler(HandlerHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
}
