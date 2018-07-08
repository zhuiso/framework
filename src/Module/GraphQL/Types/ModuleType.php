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
 * Class ModuleType.
 */
class ModuleType extends AbstractType
{
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'authors'        => [
                'description' => '',
                'type'        => Type::string(),
            ],
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
        return 'module';
    }
}
