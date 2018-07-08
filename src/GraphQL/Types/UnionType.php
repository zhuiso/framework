<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\GraphQL\Types;

use GraphQL\Type\Definition\UnionType as UnionObjectType;

/**
 * Class UnionType.
 */
class UnionType extends InterfaceType
{
    /**
     * @return array
     */
    public function types()
    {
        return [];
    }

    /**
     * @return array|mixed
     */
    public function getTypes()
    {
        $attributesTypes = array_get($this->attributes, 'types', []);

        return sizeof($attributesTypes) ? $attributesTypes : $this->types();
    }

    /**
     * Get the attributes from the container.
     *
     * @return array
     */
    public function getAttributes()
    {
        $attributes = parent::getAttributes();
        $types = $this->getTypes();
        if (isset($types)) {
            $attributes['types'] = $types;
        }

        return $attributes;
    }

    /**
     * @return \GraphQL\Type\Definition\UnionType
     */
    public function toType()
    {
        return new UnionObjectType($this->toArray());
    }
}
