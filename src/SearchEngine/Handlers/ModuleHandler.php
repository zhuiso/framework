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
use Zs\Foundation\Module\Module;
use Zs\Foundation\Module\ModuleManager;
use Zs\Foundation\Routing\Abstracts\Handler;
use Zs\Foundation\Setting\Contracts\SettingsRepository;

/**
 * Class ModuleHandler.
 */
class ModuleHandler extends Handler
{
    /**
     * @var \Zs\Foundation\Module\ModuleManager
     */
    protected $module;

    /**
     * @var \Zs\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $setting;

    /**
     * ModuleHandler constructor.
     *
     * @param \Illuminate\Container\Container                         $container
     * @param \Zs\Foundation\Module\ModuleManager                 $module
     * @param \Zs\Foundation\Setting\Contracts\SettingsRepository $setting
     */
    public function __construct(Container $container, ModuleManager $module, SettingsRepository $setting)
    {
        parent::__construct($container);
        $this->module = $module;
        $this->setting = $setting;
    }

    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {
        $modules = collect();
        $this->module->enabled()->each(function (Module $module) use ($modules) {
            $modules->put($module->identification(), [
                'alias'          => $this->setting->get('module.' . $module->identification() . '.domain.alias', ''),
                'identification' => Str::replaceFirst('/', '-', $module->identification()),
                'name'           => $module->get('name'),
                'order'          => intval($this->setting->get('module.' . $module->identification() . '.seo.order', 0)),
            ]);
        });
        $modules->put('global', [
            'alias'          => '/',
            'identification' => 'global',
            'name'           => '全局',
            'order'          => 99999,
        ]);
        $modules->forget('zs/administration');
        $this->withCode(200)->withData($modules->sortBy('order'))->withMessage('获取模块列表成功！');
    }
}
