<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Module\Controllers;

use Zs\Foundation\Module\Handlers\ExportsHandler;
use Zs\Foundation\Module\Handlers\ImportsHandler;
use Zs\Foundation\Module\Handlers\UpdateHandler;
use Zs\Foundation\Routing\Abstracts\Controller;

/**
 * Class ModuleController.
 */
class ModuleController extends Controller
{
    /**
     * @var array
     */
    protected $permissions = [
        'global::global::module::module.manage' => [
            'enable',
            'handle',
            'install',
            'uninstall',
            'update',
        ],
    ];

    /**
     * @param \Zs\Foundation\Module\Handlers\ExportsHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function exports(ExportsHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * @param \Zs\Foundation\Module\Handlers\ImportsHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function imports(ImportsHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * Update Handler.
     *
     * @param \Zs\Foundation\Module\Handlers\UpdateHandler $handler
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function update(UpdateHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }
}
