<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http;

use Illuminate\Http\RedirectResponse as IlluminateRedirectResponse;
use Illuminate\Support\ViewErrorBag;

/**
 * Class RedirectResponse.
 */
class RedirectResponse extends IlluminateRedirectResponse
{
    /**
     * Return messages to redirect response.
     *
     * @param \Illuminate\Contracts\Support\MessageProvider|array|string $provider
     * @param string                                                     $key
     *
     * @return $this
     */
    public function withMessages($provider, $key = 'default')
    {
        $value = $this->parseErrors($provider);
        $this->session->flash(
            'messages', $this->session->get('messages', new ViewErrorBag)->put($key, $value)
        );

        return $this;
    }
}
