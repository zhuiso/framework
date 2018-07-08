<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Cache\Controllers;

use Zs\Foundation\Cache\Queues\FlushAll;
use Zs\Foundation\Routing\Abstracts\Controller;

/**
 * Class RedisController.
 */
class RedisController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle()
    {
        FlushAll::dispatch();

        return $this->response->json([
            'message' => '清除缓存成功！',
        ]);
    }
}
