<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Flow\Events;

use Illuminate\Container\Container;
use Zs\Foundation\Flow\FlowManager;

/**
 * Class FlowRegister.
 */
class FlowRegister
{
    /**
     * @var \Zs\Foundation\Flow\FlowManager
     */
    protected $flow;

    /**
     * FlowRegister constructor.
     *
     * @param \Zs\Foundation\Flow\FlowManager $flow
     */
    public function __construct(FlowManager $flow)
    {
        $this->flow = $flow;
    }
}
