<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Addon\GraphQL\Queries;

use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\Type;
use Zs\Foundation\GraphQL\Abstracts\Query;

/**
 * Class ConfigurationQuery.
 */
class AddonQuery extends Query
{
    /**
     * @return array
     */
    public function args()
    {
        return [
            'enabled'   => [
                'defaultValue' => null,
                'name'         => 'enabled',
                'type'         => Type::boolean(),
            ],
            'installed' => [
                'defaultValue' => null,
                'name'         => 'installed',
                'type'         => Type::boolean(),
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     *
     * @return array
     */
    public function resolve($root, $args)
    {
        if ($args['enabled'] === true) {
            return $this->addon->enabled()->toArray();
        } else if ($args['installed'] === true) {
            return $this->addon->installed()->toArray();
        } else if ($args['installed'] === false) {
            return $this->addon->notInstalled()->toArray();
        }

        return $this->addon->repository()->toArray();
    }

    /**
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function type(): ListOfType
    {
        return Type::listOf($this->graphql->type('addon'));
    }
}
