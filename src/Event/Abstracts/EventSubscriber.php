<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Event\Abstracts;

use Exception;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Str;

/**
 * Class EventSubscriber.
 */
abstract class EventSubscriber
{
    /**
     * @var \Illuminate\Container\Container|\Zs\Foundation\Application
     */
    protected $container;

    /**
     * @var \Illuminate\Events\Dispatcher
     */
    protected $events;

    /**
     * EventSubscriber constructor.
     *
     * @param \Illuminate\Container\Container $container
     * @param \Illuminate\Events\Dispatcher   $events
     */
    public function __construct(Container $container, Dispatcher $events)
    {
        $this->container = $container;
        $this->events = $events;
    }

    /**
     * Name of event.
     *
     * @throws \Exception
     * @return string|object
     */
    abstract protected function getEvent();

    /**
     * Event subscribe handler.
     *
     * @throws \Exception
     */
    public function subscribe()
    {
        $method = 'handle';
        if (method_exists($this, $getHandler = 'get' . Str::ucfirst($method) . 'r')) {
            $method = $this->{$getHandler}();
        }
        $this->events->listen($this->getEvent(), [
            $this,
            $method,
        ]);
    }
}
