<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Administration\GraphQL\Queries;

use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\Type;
use Zs\Foundation\GraphQL\Abstracts\Query;

/**
 * Class NavigationQuery.
 */
class NavigationQuery extends Query
{
    /**
     * @param $root
     * @param $args
     *
     * @return array
     */
    public function resolve($root, $args)
    {
        // TODO: Implement resolve() method.
    }

    /**
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function type(): ListOfType
    {
        return Type::listOf(Type::string());
    }
}
