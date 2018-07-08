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
 * Class MenuController.
 */
class MenusController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        return $this->response->json([
            'data'      => $this->module->menus()->structures()->toArray(),
            'message'   => '获取菜单数据成功！',
            'originals' => $this->module->menus()->toArray(),
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $data = $this->request->input('data');
        foreach ($data as $key=>$value) {
            unset($data[$key]['icon']);
            unset($data[$key]['parent']);
            unset($data[$key]['expand']);
            unset($data[$key]['path']);
            unset($data[$key]['permission']);
        }
        $this->setting->set('administration.menus', json_encode($data));
        $this->cache->tags('zs')->flush();

        return $this->response->json([
            'message' => '批量更新数据成功！',
        ]);
    }
}
