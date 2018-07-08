<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\SearchEngine\Models;

use Zs\Foundation\Database\Model;

/**
 * Class Rule.
 */
class Rule extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'open'  => 'boolean',
        'order' => 'integer',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'module',
        'open',
        'order',
        'path',
        'template',
    ];

    /**
     * @var string
     */
    protected $table = 'seo_rules';
}
