<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Administration\Controllers;

use Illuminate\Support\Str;
use Zs\Foundation\Routing\Abstracts\Controller;

/**
 * Class ConfigurationsController.
 */
class ConfigurationsController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function definition($path)
    {
        $path = Str::replaceFirst('-', '/', $path);
        $page = $this->administration->pages()->filter(function ($definition) use ($path) {
            return $definition['initialization']['path'] == $path;
        })->first();

        return $this->response->json([
            'data'    => $page,
            'message' => '获取数据成功！',
        ]);
    }
}
