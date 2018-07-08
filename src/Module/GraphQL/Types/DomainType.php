<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Module\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Zs\Foundation\GraphQL\Abstracts\Type as AbstractType;

/**
 * Class DomainType.
 */
class DomainType extends AbstractType
{
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'alias'          => [
                'description' => '',
                'type'        => Type::string(),
            ],
            'default'        => [
                'description' => '',
                'type'        => Type::boolean(),
            ],
            'enabled'        => [
                'description' => '',
                'type'        => Type::boolean(),
            ],
            'host'           => [
                'description' => '',
                'type'        => Type::string(),
            ],
            'identification' => [
                'description' => '',
                'type'        => Type::string(),
            ],
            'name'           => [
                'description' => '',
                'type'        => Type::string(),
            ],
        ];
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'moduleDomain';
    }
}
