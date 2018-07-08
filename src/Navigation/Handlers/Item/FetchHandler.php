<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Navigation\Handlers\Item;

use Zs\Foundation\Navigation\Models\Item;
use Zs\Foundation\Routing\Abstracts\Handler;

/**
 * Class FetchHandler.
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
        $this->withCode(200)
            ->withData((new Item())->structure($this->request->input('group')))
            ->withMessage('content::category.fetch.success');
    }
}
