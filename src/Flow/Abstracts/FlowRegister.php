<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Flow\Abstracts;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Zs\Foundation\Event\Abstracts\EventSubscriber;
use Zs\Foundation\Flow\Events\FlowRegister as FlowRegisterEvent;
use Zs\Foundation\Flow\FlowManager;

/**
 * Class FlowRegister.
 */
abstract class FlowRegister extends EventSubscriber
{
    /**
     * @var \Zs\Foundation\Flow\FlowManager
     */
    protected $flow;

    /**
     * FlowRegister constructor.
     *
     * @param \Illuminate\Container\Container     $container
     * @param \Illuminate\Events\Dispatcher       $events
     * @param \Zs\Foundation\Flow\FlowManager $flow
     */
    public function __construct(Container $container, Dispatcher $events, FlowManager $flow)
    {
        parent::__construct($container, $events);
        $this->flow = $flow;
    }

    /**
     * Name of event.
     *
     * @throws \Exception
     * @return string|object
     */
    protected function getEvent()
    {
        return FlowRegisterEvent::class;
    }

    /**
     * Register flow or flows.
     */
    abstract public function handle();
}
