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
use Zs\Foundation\SearchEngine\Models\Rule as SeoRule;
use Zs\Foundation\Validation\Rule;

/**
 * Class ListHandler.
 */
class ListHandler extends Handler
{
    /**
     * @var bool
     */
    protected $onlyValues = true;

    /**
     * @var \Zs\Foundation\Module\ModuleManager
     */
    protected $module;

    /**
     * ListHandler constructor.
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
        list($identification) = $this->validate($this->request, [
            'identification' => Rule::required(),
        ], [
            'identification.required' => '模块标识必须填写',
        ]);
        $identification = Str::replaceFirst('-', '/', $identification);
        if ($this->module->has($identification) || $identification == 'global') {
            $builder = SeoRule::query();
            $builder->orderBy('order', 'asc');
            $builder->where('module', $identification);
            $this->withCode(200)->withData($builder->get())->withExtra([
                'module' => $identification == 'global' ? '全局' : $this->module->get($identification)->get('name'),
            ])->withMessage('获取数据成功！');
        } else {
            $this->withCode(500)->withError('模块不存在！');
        }
    }
}
