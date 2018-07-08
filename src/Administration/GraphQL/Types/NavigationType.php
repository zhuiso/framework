<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Administration\GraphQL\Types;

use Zs\Foundation\GraphQL\Abstracts\Type;

/**
 * Class MenuType.
 */
class NavigationType extends \Zs\Foundation\GraphQL\Abstracts\Type
{
    /**
     * @return array
     */
    public function fields()
    {
        return [];
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'AdministrationNavigation';
    }
}
