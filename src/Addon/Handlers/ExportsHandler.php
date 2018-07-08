<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------

namespace Zs\Foundation\Addon\Handlers;

use Carbon\Carbon;
use Illuminate\Container\Container;
use Zs\Foundation\Addon\Addon;
use Zs\Foundation\Addon\AddonManager;
use Zs\Foundation\Routing\Abstracts\Handler;
use Zs\Foundation\Setting\Contracts\SettingsRepository;
use Zs\Foundation\Validation\Rule;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ExportsHandler.
 */
class ExportsHandler extends Handler
{
    /**
     * @var \Zs\Foundation\Addon\AddonManager
     */
    protected $extension;

    /**
     * @var \Zs\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $setting;

    /**
     * ExportsHandler constructor.
     *
     * @param \Illuminate\Container\Container                         $container
     * @param \Zs\Foundation\Addon\AddonManager                   $extension
     * @param \Zs\Foundation\Setting\Contracts\SettingsRepository $setting
     */
    public function __construct(Container $container, AddonManager $extension, SettingsRepository $setting)
    {
        parent::__construct($container);
        $this->extension = $extension;
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
            'extensions' => [
                Rule::array(),
                Rule::required(),
            ],
        ], [
            'extensions.array'    => '插件数据必须为数组',
            'extensions.required' => '插件数据必须填写',
        ]);
        $output = collect();
        collect($this->request->input('extensions'))->each(function ($identification) use ($output) {
            $extension = $this->extension->get($identification);
            $exports = collect();
            if ($extension instanceof Addon) {
                $exports->put('name', $extension->offsetGet('name'));
                $exports->put('version', $extension->offsetGet('version'));
                $exports->put('time', Carbon::now());
                $exports->put('secret', false);
                $settings = collect($extension->get('settings', []));
                $settings->count() && $exports->put('settings', $settings->map(function ($default, $key) {
                    return $this->setting->get($key, $default);
                }));
                $output->put($identification, $exports);
            }
        });
        $output = Yaml::dump($output->toArray(), 8);
        $this->withCode(200)->withData([
            'content' => $output,
            'file'    => 'Zs extension export ' . Carbon::now()->format('Y-m-d H:i:s') . '.yaml',
        ])->withMessage('导出数据成功！');
    }
}
