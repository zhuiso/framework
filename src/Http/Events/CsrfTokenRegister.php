<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Events;

use Zs\Foundation\Http\Middlewares\VerifyCsrfToken;

/**
 * Class CsrfTokenRegister.
 */
class CsrfTokenRegister
{
    /**
     * @var \Zs\Foundation\Http\Middlewares\VerifyCsrfToken
     */
    protected $verifier;

    /**
     * CsrfTokenRegister constructor.
     *
     * @param \Zs\Foundation\Http\Middlewares\VerifyCsrfToken $verifier
     *
     * @internal param \Illuminate\Container\Container $container
     */
    public function __construct(VerifyCsrfToken $verifier)
    {
        $this->verifier = $verifier;
    }

    /**
     * Register except to verifier.
     *
     * @param $excepts
     */
    public function registerExcept($excepts)
    {
        $this->verifier->registerExcept($excepts);
    }
}
