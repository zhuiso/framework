<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Addon\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Zs\Foundation\GraphQL\Abstracts\Type as AbstractType;

/**
 * Class AddonType.
 */
class AddonType extends AbstractType
{
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'description'    => [
                'description' => '',
                'type'        => Type::string(),
            ],
            'enabled'        => [
                'description' => '',
                'type'        => Type::boolean(),
            ],
            'identification' => [
                'description' => '',
                'type'        => Type::string(),
            ],
            'name'           => [
                'description' => '',
                'type'        => Type::string(),
            ],
            'namespace'      => [
                'description' => '',
                'type'        => Type::string(),
            ],
            'provider'       => [
                'description' => '',
                'type'        => Type::string(),
            ],
            'version'        => [
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
        return 'addon';
    }
}
