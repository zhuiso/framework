<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Extension\GraphQL\Mutations;

use GraphQL\Type\Definition\Type;
use Zs\Foundation\GraphQL\Abstracts\Mutation;

/**
 * Class ConfigurationMutation.
 */
class InstallMutation extends Mutation
{
    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'identification' => [
                'name' => 'identification',
                'type' => Type::string(),
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
        // TODO: Implement resolve() method.
    }
}
