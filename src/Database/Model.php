<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Database;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Zs\Foundation\Database\Traits\HasSetters;
use Zs\Foundation\Database\Traits\MacroRelation;

/**
 * Class Model.
 */
class Model extends EloquentModel
{
    use HasSetters, MacroRelation;
}
