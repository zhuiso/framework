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
 * Class CreateHandler.
 */
class CreateHandler extends Handler
{
    /**
     * Execute Handler.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function execute()
    {
        $this->validate($this->request, [
            'title' => 'required',
            'alias' => 'required|alpha_dash|unique:menu_groups',
        ], [
            'alias.required' => '必须填写分组别名',
            'alias.alpha_dash' => '分组别名只能包含字母、数字、破折号（ - ）以及下划线（ _ ）',
            'alias.unique' => '分组别名已被占用',
            'title.required' => '必须填写分组标题',
        ]);
        Group::query()->create([
            'alias' => $this->request->input('alias'),
            'title' => $this->request->input('title'),
        ]);
        $this->withCode(200)->withMessage('content::category.create.success');
    }
}
