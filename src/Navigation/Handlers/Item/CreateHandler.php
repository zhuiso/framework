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
 * Class CreateHandler.
 */
class CreateHandler extends Handler
{
    /**
     * Execute Handler.
     */
    public function execute()
    {
        if (Item::query()->create([
            'color'      => $this->request->input('color'),
            'enabled'    => $this->request->input('enabled'),
            'group_id'   => $this->request->input('group_id'),
            'icon_image' => $this->request->input('icon_image'),
            'link'       => $this->request->input('link'),
            'order_id'   => 0,
            'parent_id'  => 0,
            'target'     => $this->request->input('target'),
            'title'      => $this->request->input('title'),
            'tooltip'    => $this->request->input('tooltip'),
        ])) {
            $this->withCode(200)->withMessage('content::category.create.success');
        } else {
            $this->withCode(500)->withError('');
        }
    }
}
