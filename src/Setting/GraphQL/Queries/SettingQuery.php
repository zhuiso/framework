<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Setting\GraphQL\Queries;

use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\Type;
use Zs\Foundation\GraphQL\Abstracts\Query;

/**
 * Class SettingQuery.
 */
class SettingQuery extends Query
{
    /**
     * @return array
     */
    public function args()
    {
        return [
            'key' => [
                'name' => 'key',
                'type' => Type::string(),
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     *
     * @return mixed
     */
    public function resolve($root, $args)
    {
        if (isset($args['key'])) {
            return is_array($this->setting->get($args['key'])) ? $this->setting->get($args['key']) : [
                $this->setting->get($args['key']),
            ];
        }

        return [null];
    }

    /**
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function type(): ListOfType
    {
        return Type::listOf(Type::string());
    }
}
