<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Cache\Queues;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Zs\Foundation\Bus\Dispatchable;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class FlushAll.
 */
class FlushAll implements ShouldQueue
{
    use Dispatchable, Helpers, InteractsWithQueue, Queueable;

    /**
     * Handle Queue.
     */
    public function handle()
    {
        $this->cache->tags('zs')->flush();
    }
}
