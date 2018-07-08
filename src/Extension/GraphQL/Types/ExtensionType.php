<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Extension\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Zs\Foundation\GraphQL\Abstracts\Type as AbstractType;

/**
 * Class ExtensionType.
 */
class ExtensionType extends AbstractType
{
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'authors' => [
                'description' => '',
                'type'        => Type::string(),
            ],
            'description' => [
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
            'initialized' => [
                'description' => '',
                'type'        => Type::boolean(),
            ],
            'installed' => [
                'description' => '',
                'type'        => Type::boolean(),
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
            'requireInstall'       => [
                'description' => '',
                'type'        => Type::boolean(),
            ],
            'requireUninstall'       => [
                'description' => '',
                'type'        => Type::boolean(),
            ],
        ];
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'extension';
    }
}
