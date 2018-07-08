<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\GraphQL\Types;

use GraphQL\Type\Definition\InputObjectType;
use Zs\Foundation\GraphQL\Abstracts\Type;

/**
 * Class InputType.
 */
class InputType extends Type
{
    public function toType()
    {
        return new InputObjectType($this->toArray());
    }

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
        return 'input';
    }
}
