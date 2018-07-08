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
 * Class EditHandler.
 */
class EditHandler extends Handler
{
    /**
     * Execute Handler.
     */
    public function execute()
    {
        $article = Item::query()->find($this->request->input('id'));
        if ($article && $article->update([
                'color'      => $this->request->input('color'),
                'enabled'    => $this->request->input('enabled'),
                'group_id'   => $this->request->input('group_id'),
                'icon_image' => $this->request->input('icon_image'),
                'link'       => $this->request->input('link'),
                'order_id'   => $this->request->input('order_id'),
                'parent_id'  => $this->request->input('parent_id'),
                'target'     => $this->request->input('target'),
                'title'      => $this->request->input('title'),
                'tooltip'    => $this->request->input('tooltip'),
            ])
        ) {
            $this->withCode(200)->withMessage('content::article.update.success');
        } else {
            $this->withCode(500)->withError('');
        }
    }
}
