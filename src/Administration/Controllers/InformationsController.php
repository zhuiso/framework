<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Administration\Controllers;

use Zs\Foundation\Routing\Abstracts\Controller;

/**
 * Class InformationsController.
 */
class InformationsController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        return $this->response->json([
            'data'    => [
                'navigation'  => $this->administration->navigations()->toArray(),
                'pages'       => $this->administration->pages()->toArray(),
                'scripts'     => $this->administration->scripts()->toArray(),
                'stylesheets' => $this->administration->stylesheets()->toArray(),
            ],
            'message' => '获取模块和插件信息成功！',
        ]);
    }
}
