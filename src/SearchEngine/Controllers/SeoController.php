<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\SearchEngine\Controllers;

use Zs\Foundation\Routing\Abstracts\ApiController;
use Zs\Foundation\SearchEngine\Handlers\BatchHandler;
use Zs\Foundation\SearchEngine\Handlers\CreateHandler;
use Zs\Foundation\SearchEngine\Handlers\EditHandler;
use Zs\Foundation\SearchEngine\Handlers\ListHandler;
use Zs\Foundation\SearchEngine\Handlers\ModuleHandler;
use Zs\Foundation\SearchEngine\Handlers\OrderHandler;
use Zs\Foundation\SearchEngine\Handlers\RemoveHandler;
use Zs\Foundation\SearchEngine\Handlers\SeoHandler;
use Zs\Foundation\SearchEngine\Handlers\TemplateHandler;

/**
 * Class SeoController.
 */
class SeoController extends ApiController
{
    /**
     * @var array
     */
    protected $permissions = [
        'global::global::search-engine::seo.set' => 'set',
    ];

    /**
     * @param \Zs\Foundation\SearchEngine\Handlers\BatchHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function batch(BatchHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param \Zs\Foundation\SearchEngine\Handlers\CreateHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function create(CreateHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param \Zs\Foundation\SearchEngine\Handlers\EditHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function edit(EditHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param \Zs\Foundation\SearchEngine\Handlers\ListHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function list(ListHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param \Zs\Foundation\SearchEngine\Handlers\ModuleHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function module(ModuleHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param \Zs\Foundation\SearchEngine\Handlers\OrderHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function order(OrderHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param \Zs\Foundation\SearchEngine\Handlers\RemoveHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function remove(RemoveHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param \Zs\Foundation\SearchEngine\Handlers\SeoHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function seo(SeoHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param \Zs\Foundation\SearchEngine\Handlers\TemplateHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function template(TemplateHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
}
