<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Navigation\Controllers;

use Zs\Foundation\Navigation\Handlers\Item\CreateHandler;
use Zs\Foundation\Navigation\Handlers\Item\DeleteHandler;
use Zs\Foundation\Navigation\Handlers\Item\EditHandler;
use Zs\Foundation\Navigation\Handlers\Item\FetchHandler;
use Zs\Foundation\Navigation\Handlers\Item\SortHandler;
use Zs\Foundation\Routing\Abstracts\Controller;

/**
 * Class ItemController.
 */
class ItemController extends Controller
{
    /**
     * Create handler.
     *
     * @param \Zs\Foundation\Navigation\Handlers\Item\CreateHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function create(CreateHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * Delete handler.
     *
     * @param \Zs\Foundation\Navigation\Handlers\Item\DeleteHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function delete(DeleteHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * Edit handler.
     *
     * @param \Zs\Foundation\Navigation\Handlers\Item\EditHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function edit(EditHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * Fetch handler.
     *
     * @param \Zs\Foundation\Navigation\Handlers\Item\FetchHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function fetch(FetchHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * Sort handler.
     *
     * @param \Zs\Foundation\Navigation\Handlers\Item\SortHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function sort(SortHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
}
