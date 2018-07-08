<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Cache\GraphQL\Mutations;

use Zs\Foundation\GraphQL\Abstracts\Mutation;

/**
 * Class ConfigurationMutation.
 */
class ClearMutation extends Mutation
{
    /**
     * @return array
     */
    public function args(): array
    {
        return [];
    }

    /**
     * @param $root
     * @param $args
     *
     * @return mixed|void
     */
    public function resolve($root, $args)
    {
        // TODO: Implement resolve() method.
    }
}
