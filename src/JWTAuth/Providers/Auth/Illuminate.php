<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth\Providers\Auth;

use Zs\Foundation\JWTAuth\Contracts\Providers\Auth;
use Illuminate\Contracts\Auth\Guard as GuardContract;

class Illuminate implements Auth
{
    /**
     * The authentication guard.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * Constructor.
     *
     * @param \Illuminate\Contracts\Auth\Guard  $auth
     *
     * @return void
     */
    public function __construct(GuardContract $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Check a user's credentials.
     *
     * @param array  $credentials
     *
     * @return bool
     */
    public function byCredentials(array $credentials)
    {
        return $this->auth->once($credentials);
    }

    /**
     * Authenticate a user via the id.
     *
     * @param mixed  $id
     *
     * @return bool
     */
    public function byId($id)
    {
        return $this->auth->onceUsingId($id);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->auth->user();
    }
}
