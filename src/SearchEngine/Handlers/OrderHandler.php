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
use Zs\Foundation\Module\ModuleManager;
use Zs\Foundation\Routing\Abstracts\Handler;
use Zs\Foundation\Setting\Contracts\SettingsRepository;
use Zs\Foundation\Validation\Rule;

/**
 * Class OrderHandler.
 */
class OrderHandler extends Handler
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
     * @var \Zs\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    /**
     * OrderHandler constructor.
     *
     * @param \Illuminate\Container\Container                         $container
     * @param \Zs\Foundation\Module\ModuleManager                 $module
     * @param \Zs\Foundation\Setting\Contracts\SettingsRepository $settings
     */
    public function __construct(Container $container, ModuleManager $module, SettingsRepository $settings)
    {
        parent::__construct($container);
        $this->settings = $settings;
        $this->module = $module;
    }

    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {
        list($identification, $order) = $this->validate($this->request, [
            'identification' => Rule::required(),
            'order'          => [
                Rule::numeric(),
                Rule::required(),
            ],
        ], [
            'identification.required' => '模块表示必须填写',
            'order.numeric'           => '匹配排序必须为数值',
            'order.required'          => '匹配排序必须填写',
        ]);
        $this->settings->set('module.' . $identification . '.seo.order', $order);
        $this->withCode(200)->withMessage('设置模块匹配排序成功！');
    }
}
