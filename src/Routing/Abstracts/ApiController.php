<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Routing\Abstracts;

/**
 * Class ApiController.
 */
abstract class ApiController extends Controller
{
    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Send something for handler.
     *
     * @param $handler
     */
    public function send($handler)
    {
    }
}
