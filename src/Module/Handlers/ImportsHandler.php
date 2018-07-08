<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Module\Handlers;

use Illuminate\Container\Container;
use Zs\Foundation\Module\ModuleManager;
use Zs\Foundation\Routing\Abstracts\Handler;
use Zs\Foundation\Setting\Contracts\SettingsRepository;
use Zs\Foundation\Validation\Rule;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ImportsHandler.
 */
class ImportsHandler extends Handler
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
     * ImportsHandler constructor.
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
        $this->validate($this->request, [
            'file' => [
                Rule::file(),
                Rule::required(),
            ],
        ], [
            'file.file'     => '文件必须成功上传',
            'file.required' => '文件必须上传',
        ]);
        $configurations = Yaml::parse(file_get_contents($this->request->file('file')->getRealPath()));
        $configurations = collect($configurations);
        if ($configurations->count()) {
            $configurations->each(function ($data, $identification) {
                $data = collect($data);
                $identification = trim($identification);
                if ($this->module->has($identification)) {
                    $data->has('settings') && collect($data->get('settings', []))->each(function ($value, $key) {
                        $this->setting->set($key, $value);
                    });
                }
            });
            $this->withCode(200)->withData($configurations)->withMessage('导入模块配置成功！');
        } else {
            $this->withCode(500)->withError('导入模块配置失败！');
        }
    }
}
