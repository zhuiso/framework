<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Navigation\Controllers;

use Zs\Foundation\Navigation\Handlers\Group\CreateHandler;
use Zs\Foundation\Navigation\Handlers\Group\DeleteHandler;
use Zs\Foundation\Navigation\Handlers\Group\EditHandler;
use Zs\Foundation\Navigation\Handlers\Group\FetchHandler;
use Zs\Foundation\Routing\Abstracts\Controller;

/**
 * Class GroupController.
 */
class GroupController extends Controller
{
    /**
     * Created handler.
     *
     * @param \Zs\Foundation\Navigation\Handlers\Group\CreateHandler $handler
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
     * @param \Zs\Foundation\Navigation\Handlers\Group\DeleteHandler $handler
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
     * @param \Zs\Foundation\Navigation\Handlers\Group\EditHandler $handler
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
     * @param \Zs\Foundation\Navigation\Handlers\Group\FetchHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function fetch(FetchHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
}
