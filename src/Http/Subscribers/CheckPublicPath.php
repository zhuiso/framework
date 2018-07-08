<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Subscribers;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Events\RouteMatched;
use Zs\Foundation\Event\Abstracts\EventSubscriber;

/**
 * Class CheckPublicPath.
 */
class CheckPublicPath extends EventSubscriber
{
    /**
     * @var \Illuminate\Routing\Router
     */
    protected $request;

    /**
     * CheckPublicPath constructor.
     *
     * @param \Illuminate\Container\Container $container
     * @param \Illuminate\Events\Dispatcher   $events
     * @param \Illuminate\Http\Request        $router
     */
    public function __construct(Container $container, Dispatcher $events, Request $router)
    {
        parent::__construct($container, $events);
        $this->request = $router;
    }

    /**
     * Name of event.
     *
     * @throws \Exception
     * @return string|object
     */
    protected function getEvent()
    {
        return RouteMatched::class;
    }

    public function handle()
    {
        if ($this->request->getBasePath() == '/public') {
            throw new \Exception('public目录 必须为网站根目录');
        }
    }
}
