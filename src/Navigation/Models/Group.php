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
 * Class Group.
 */
class Group extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'alias',
        'title',
    ];

    /**
     * @var string
     */
    protected $table = 'menu_groups';
}
