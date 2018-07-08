<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Routing;

use Illuminate\Routing\Redirector as IlluminateRedirector;
use Zs\Foundation\Http\RedirectResponse;

/**
 * Class Redirector.
 */
class Redirector extends IlluminateRedirector
{
    /**
     * Create a new redirect response.
     *
     * @param string $path
     * @param int    $status
     * @param array  $headers
     *
     * @return \Zs\Foundation\Http\RedirectResponse
     */
    public function createRedirect($path, $status, $headers)
    {
        $redirect = new RedirectResponse($path, $status, $headers);
        if (isset($this->session)) {
            $redirect->setSession($this->session);
        }
        $redirect->setRequest($this->generator->getRequest());

        return $redirect;
    }
}
