<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Setting\GraphQL\Mutations;

use GraphQL\Type\Definition\Type;
use Zs\Foundation\GraphQL\Abstracts\Mutation;

/**
 * Class SettingMutation.
 */
class SettingMutation extends Mutation
{
    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'key'   => [
                'name' => 'key',
                'type' => Type::nonNull(Type::string()),
            ],
            'value' => [
                'name' => 'value',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     *
     * @return mixed|void
     */
    public function resolve($root, $args)
    {
        $this->setting->set($args['key'], $args['value']);
        $this->cache->tags('zs')->flush();
    }

    /**
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function type()
    {
        return Type::listOf(Type::string());
    }
}
