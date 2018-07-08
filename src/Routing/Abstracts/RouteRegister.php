<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Routing\Abstracts;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Zs\Foundation\Event\Abstracts\EventSubscriber;
use Zs\Foundation\Routing\Router;
use Zs\Foundation\Routing\Events\RouteRegister as RouteRegisterEvent;

/**
 * Class AbstractRouteRegister.
 */
abstract class RouteRegister extends EventSubscriber
{
    /**
     * @var \Zs\Foundation\Routing\Router
     */
    protected $router;

    /**
     * RouteRegister constructor.
     *
     * @param \Illuminate\Container\Container $container
     * @param \Illuminate\Events\Dispatcher   $events
     * @param \Zs\Foundation\Routing\Router $router
     */
    public function __construct(Container $container, Dispatcher $events, Router $router)
    {
        parent::__construct($container, $events);
        $this->router = $router;
    }

    /**
     * Name of event.
     *
     * @return mixed
     */
    protected function getEvent()
    {
        return RouteRegisterEvent::class;
    }

    /**
     * Handle Route Register.
     */
    abstract public function handle();
}
