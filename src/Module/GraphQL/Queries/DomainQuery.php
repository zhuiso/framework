<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Module\GraphQL\Queries;

use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\Type;
use Zs\Foundation\GraphQL\Abstracts\Query;
use Zs\Foundation\Module\Module;

/**
 * Class DomainQuery.
 */
class DomainQuery extends Query
{
    /**
     * @param $root
     * @param $args
     *
     * @return mixed
     */
    public function resolve($root, $args)
    {
        $domains = $this->module->enabled()->map(function (Module $module) {
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

        return $domains->toArray();
    }

    /**
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function type(): ListOfType
    {
        return Type::listOf($this->graphql->type('moduleDomain'));
    }
}