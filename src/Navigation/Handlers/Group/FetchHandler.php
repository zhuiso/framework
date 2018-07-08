<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Navigation\Handlers\Group;

use Illuminate\Container\Container;
use Zs\Foundation\Navigation\Models\Group;
use Zs\Foundation\Routing\Abstracts\Handler;

/**
 * Class Fetch.
 */
class FetchHandler extends Handler
{
    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {
        $this->withCode(200)->withData(Group::query()->get()->toArray())->withMessage('content::category.fetch.success');
    }
}
