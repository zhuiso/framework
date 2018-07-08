<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Module\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Zs\Foundation\Module\Abstracts\Installation;
use Zs\Foundation\Module\Module;
use Zs\Foundation\Routing\Abstracts\Controller;
use Zs\Foundation\Validation\Rule;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

/**
 * Class ModulesController.
 */
class ModulesController extends Controller
{
    /**
     * @var bool
     */
    protected $onlyValues = true;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function enable(): JsonResponse
    {
        list($identification, $status) = $this->validate($this->request, [
            'identification' => Rule::required(),
            'status'         => Rule::required(),
        ], [
            'identification.required' => '模块标识必须填写',
            'status.required'         => '模块状态值必须填写',
        ]);
        if (!$this->module->has($identification)) {
            return $this->response->json([
                'message' => '不存在模块[' . $identification . ']',
            ])->setStatusCode(500);
        }
        if (!$this->module->installed()->has($identification)) {
            return $this->response->json([
                'message' => '模块[' . $identification . ']尚未安装！',
            ])->setStatusCode(500);
        }
        $key = 'module.' . $identification . '.enabled';
        $this->setting->set($key, boolval($status));
        $this->cache->tags('zs')->flush();

        return $this->response->json([
            'message' => '切换模块开启状态成功！',
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function install(): JsonResponse
    {
        list($identification) = $this->validate($this->request, [
            'identification' => Rule::required(),
        ], [
            'identification.required' => '模块标识必须填写',
        ]);
        if (!$this->module->has($identification)) {
            $this->response->json([
                'message' => '模块[' . $identification . ']不存在！',
            ])->setStatusCode(500);
        }
        set_time_limit(0);
        $module = $this->module->get($identification);
        $output = new BufferedOutput();
        $this->db->transaction(function () use ($module, $output) {
            $installation = $module->get('namespace') . 'Installation';
            class_exists($installation) && $installation = $this->container->make($installation);
            if ($installation instanceof Installation) {
                $installation->preInstall();
            }
            if ($module->offsetExists('migrations')) {
                $migrations = (array)$module->get('migrations');
                collect($migrations)->each(function ($path) use ($module, $output) {
                    $path = $module->get('directory') . DIRECTORY_SEPARATOR . $path;
                    $migration = str_replace($this->container->basePath(), '', $path);
                    $migration = trim($migration, DIRECTORY_SEPARATOR);
                    $input = new ArrayInput([
                        '--path'  => $migration,
                        '--force' => true,
                    ]);
                    $this->getConsole()->find('migrate')->run($input, $output);
                });
            }
            if ($module->offsetExists('publishes')) {
                $publishes = (array)$module->get('publishes');
                collect($publishes)->each(function ($from, $to) use ($module, $output) {
                    $from = $module->get('directory') . DIRECTORY_SEPARATOR . $from;
                    $to = $this->container->basePath() . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $to;
                    if ($this->file->isFile($from)) {
                        $this->publishFile($from, $to);
                    } else {
                        if ($this->file->isDirectory($from)) {
                            $this->publishDirectory($from, $to);
                        }
                    }
                });
            }
            if ($installation instanceof Installation) {
                $installation->postInstall();
            }
        });
        $notice = 'Install Module ' . $identification . ':';
        $this->container->make('log')->info($notice, explode(PHP_EOL, $output->fetch()));
        $this->setting->set('module.' . $identification . '.installed', true);
        $this->cache->tags('zs')->flush();

        return $this->response->json([
            'message' => '安装模块成功！',
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(): JsonResponse
    {
        $enabled = $this->module->enabled();
        $installed = $this->module->installed();
        $modules = $this->module->repository();
        $notInstalled = $this->module->notInstalled();
        $domains = $enabled->map(function (Module $module) {
            $data = [];
            $alias = 'module.' . $module->identification() . '.domain.alias';
            $enabled = 'module.' . $module->identification() . '.domain.enabled';
            $host = 'module.' . $module->identification() . '.domain.host';
            $data['alias'] = $this->setting->get($alias, '');
            $data['default'] = $this->setting->get('module.default', 'zs/zs') == $module->identification();
            $data['enabled'] = boolval($this->setting->get($enabled, 0));
            $data['host'] = $this->setting->get($host, '');
            $data['identification'] = $module->identification();
            $data['name'] = $module->offsetGet('name');

            return $data;
        });
        $domains->offsetUnset('zs/administration');
        $domains->prepend([
            'alias'          => $this->setting->get('module.zs/administration.domain.alias', ''),
            'default'        => $this->setting->get('module.default', 'zs/zs') == 'zs/administration',
            'enabled'        => boolval($this->setting->get('module.zs/administration.domain.enabled', 0)),
            'host'           => $this->setting->get('module.zs/administration.domain.host', ''),
            'identification' => 'zs/administration',
            'name'           => 'Zs 后台',
        ], 'zs/administration');
        $domains->prepend([
            'alias'          => $this->setting->get('module.zs/api.domain.alias', ''),
            'default'        => $this->setting->get('module.default', 'zs/zs') == 'zs/api',
            'enabled'        => boolval($this->setting->get('module.zs/api.domain.enabled', 0)),
            'host'           => $this->setting->get('module.zs/api.domain.host', ''),
            'identification' => 'zs/api',
            'name'           => 'Zs API',
        ], 'zs/api');
        $domains->prepend([
            'alias'          => '/',
            'default'        => $this->setting->get('module.default', 'zs/zs') == 'zs/zs',
            'enabled'        => boolval($this->setting->get('module.zs/zs.domain.enabled', 0)),
            'host'           => $this->setting->get('module.zs/zs.domain.host', ''),
            'identification' => 'zs/zs',
            'name'           => 'Zs',
        ], 'zs/zs');
        $enabled->forget('zs/administration');
        $exports = $modules->map(function ($data) {
            return $data;
        });
        $installed->forget('zs/administration');
        $modules->forget('zs/administration');
        $notInstalled->forget('zs/administration');

        return $this->response->json([
            'data'    => [
                'domains'     => $domains->toArray(),
                'enabled'     => $this->info($enabled),
                'exports'     => $this->info($exports),
                'installed'   => $this->info($installed),
                'multidomain' => boolval($this->setting->get('site.multidomain', false)),
                'modules'     => $this->info($modules),
                'notInstall'  => $this->info($notInstalled),
            ],
            'message' => '获取模块数据成功！',
        ]);
    }

    /**
     * Info list.
     *
     * @param \Illuminate\Support\Collection $list
     *
     * @return array
     */
    protected function info(Collection $list)
    {
        $data = new Collection();
        $list->each(function (Module $module) use ($data) {
            $data->put($module->identification(), [
                'authors'         => collect($module->offsetGet('authors'))->implode(','),
                'enabled'        => boolval($module->offsetGet('enabled')),
                'description'    => $module->offsetGet('description'),
                'identification' => $module->identification(),
                'name'           => $module->offsetGet('name'),
                'version'        => $module->offsetGet('version'),
            ]);
        });

        return $data->toArray();
    }

    /**
     * @param string $identification
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function uninstall(string $identification): JsonResponse
    {
        $identification = Str::replaceFirst('-', '/', $identification);
        if (!$this->module->has($identification)) {
            return $this->response->json([
                'message' => '模块[' . $identification . ']不存在！',
            ])->setStatusCode(500);
        }
        if ($this->module->enabled()->has($identification)) {
            return $this->response->json([
                'message' => '模块[' . $identification . ']已开启！',
            ])->setStatusCode(500);
        }
        set_time_limit(0);
        $module = $this->module->get($identification);
        $output = new BufferedOutput();
        $this->db->transaction(function () use ($module, $output) {
            $installation = $module->get('namespace') . 'Installation';
            class_exists($installation) && $installation = $this->container->make($installation);
            if ($installation instanceof Installation) {
                $installation->postUninstall();
            }
            if ($module->offsetExists('migrations')) {
                $migrations = (array)$module->get('migrations');
                collect($migrations)->each(function ($path) use ($module, $output) {
                    $path = $module->get('directory') . DIRECTORY_SEPARATOR . $path;
                    $migration = str_replace($this->container->basePath(), '', $path);
                    $migration = trim($migration, DIRECTORY_SEPARATOR);
                    $input = new ArrayInput([
                        '--path'  => $migration,
                        '--force' => true,
                    ]);
                    $this->getConsole()->find('migrate:rollback')->run($input, $output);
                });
            }
            if ($installation instanceof Installation) {
                $installation->postUninstall();
            }
        });
        $notice = 'Uninstall Module ' . $identification . ':';
        $this->container->make('log')->info($notice, explode(PHP_EOL, $output->fetch()));
        $this->setting->set('module.' . $identification . '.installed', false);
        $this->cache->tags('zs')->flush();

        return $this->response->json([
            'message' => '卸载模块成功！',
        ]);
    }
}
