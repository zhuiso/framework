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
 * Class DeleteHandler.
 */
class DeleteHandler extends Handler
{
    /**
     * Execute Handler.
     */
    public function execute()
    {
        $category = Item::query()->find($this->request->input('id'));
        if ($category && $category->delete()) {
            $this->withCode(200)->withMessage('content::category.delete.success');
        } else {
            $this->withCode(500)->withError('');
        }
    }
}
