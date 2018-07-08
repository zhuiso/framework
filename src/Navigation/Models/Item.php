<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Navigation\Models;

use Zs\Foundation\Database\Model;

/**
 * Class Item.
 */
class Item extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'color',
        'enabled',
        'group_id',
        'icon_image',
        'link',
        'order_id',
        'parent_id',
        'target',
        'title',
        'tooltip',
    ];

    /**
     * @var string
     */
    protected $table = 'menu_items';

    /**
     * Return structured data.
     *
     * @param $groupId
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function structure($groupId)
    {
        $list = $this->newQuery()->where('group_id', $groupId)->where('parent_id', 0)->orderBy('order_id', 'asc')->get();
        $list->transform(function (Item $item) use ($groupId) {
            $parentId = $item->getAttribute('id');
            $children = $this->newQuery()->where('group_id', $groupId)->where('parent_id', $parentId)->orderBy('order_id', 'asc')->get();
            $children->transform(function (Item $item) use ($groupId) {
                $parentId = $item->getAttribute('id');
                $children = $this->newQuery()->where('group_id', $groupId)->where('parent_id', $parentId)->orderBy('order_id', 'asc')->get();
                $item->setAttribute('children', $children);
                return $item;
            });
            $item->setAttribute('children', $children);
            return $item;
        });

        return $list;
    }
}
