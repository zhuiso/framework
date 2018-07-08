<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Setting\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Zs\Foundation\GraphQL\Abstracts\Type as AbstractType;

/**
 * Class SettingType.
 */
class SettingsType extends AbstractType
{
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'key'   => [
                'description' => 'The key of the setting',
                'type'        => Type::string(),
            ],
            'value' => [
                'description' => 'The value of the setting',
                'type'        => Type::string(),
            ],
        ];
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'settings';
    }
}
