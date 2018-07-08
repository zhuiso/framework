<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Abstracts;

use Illuminate\Support\Collection;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class Repository.
 */
abstract class Repository extends Collection
{
    use Helpers;

    /**
     * Initialize.
     *
     * @param \Illuminate\Support\Collection $collection
     */
    abstract public function initialize(Collection $collection);
}
