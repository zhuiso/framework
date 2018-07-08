<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Mail\Controllers;

use Zs\Foundation\Mail\Handlers\GetHandler;
use Zs\Foundation\Mail\Handlers\SetHandler;
use Zs\Foundation\Mail\Handlers\TestHandler;
use Zs\Foundation\Routing\Abstracts\Controller;

/**
 * Class MailController.
 */
class MailController extends Controller
{
    /**
     * @var array
     */
    protected $permissions = [
        'global::global::mail::mail.manage' => [
            'get',
            'set',
        ],
    ];

    /**
     * Get handler.
     *
     * @param GetHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function get(GetHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
    
    /**
     * Set handler.
     *
     * @param \Zs\Foundation\Mail\Handlers\SetHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse * @throws \Exception
     * @throws \Exception
     */
    public function set(SetHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * Test Handler.
     *
     * @param \Zs\Foundation\Mail\Handlers\TestHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function test(TestHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
}
