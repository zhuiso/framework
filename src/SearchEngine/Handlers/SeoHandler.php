<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\SearchEngine\Handlers;

use Illuminate\Container\Container;
use Illuminate\Support\Str;
use Zs\Foundation\Module\ModuleManager;
use Zs\Foundation\Routing\Abstracts\Handler;
use Zs\Foundation\SearchEngine\Models\Rule as SearchEngineRule;
use Zs\Foundation\Validation\Rule;

/**
 * Class SeoHandler.
 */
class SeoHandler extends Handler
{
    /**
     * @var \Zs\Foundation\Module\ModuleManager
     */
    protected $module;

    /**
     * @var bool
     */
    protected $onlyValues = true;

    /**
     * SeoHandler constructor.
     *
     * @param \Illuminate\Container\Container         $container
     * @param \Zs\Foundation\Module\ModuleManager $module
     */
    public function __construct(Container $container, ModuleManager $module)
    {
        parent::__construct($container);
        $this->module = $module;
    }

    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {
        list($id, $module) = $this->validate($this->request, [
            'id'     => [
                Rule::numeric(),
                Rule::required(),
            ],
            'module' => Rule::required(),
        ], [
            'id.numeric'      => '规则 ID 必须为数值',
            'id.required'     => '规则 ID 必须填写',
            'module.required' => '模块标识必须填写',
        ]);
        $module = Str::replaceFirst('-', '/', $module);
        if ($this->module->has($module) || $module == 'global') {
            $rule = SearchEngineRule::query()->where('module', $module)->where('id', $id)->first();
            if ($rule instanceof SearchEngineRule) {
                $this->withCode(200)->withData($rule)->withExtra([
                    'module'    => $module == 'global' ? '全局' : $this->module->get($module)->get('name'),
                    'templates' => [
                        [
                            'name' => '默认模板',
                            'template' => '<h1>{{ $title }}</h1><div>{{ content }}</div>',
                        ],
                    ],
                ])->withMessage('获取规则信息成功！');
            } else {
                $this->withCode(500)->withError('模块下找不到对应的规则！');
            }
        } else {
            $this->withCode(500)->withError('模块不存在！');
        }
    }
}
