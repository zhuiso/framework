<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Mail\Subscribers;

use Zs\Foundation\Mail\Controllers\MailController;
use Zs\Foundation\Routing\Abstracts\RouteRegister as AbstractRouteRegister;

/**
 * Class RouterRegister.
 */
class RouterRegister extends AbstractRouteRegister
{
    /**
     * Handle Route Register.
     */
    public function handle()
    {
        $this->router->group(['middleware' => ['auth:api', 'cross', 'web'], 'prefix' => 'api/mail'], function () {
            $this->router->post('get', MailController::class . '@get');
            $this->router->post('set', MailController::class . '@set');
            $this->router->post('test', MailController::class . '@test');
        });
    }
}
