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
use Cartalyst\Sentinel\Sentinel as SentinelAuth;

class Sentinel implements Auth
{
    /**
     * The sentinel authentication.
     *
     * @var \Cartalyst\Sentinel\Sentinel
     */
    protected $sentinel;

    /**
     * Constructor.
     *
     * @param \Cartalyst\Sentinel\Sentinel  $sentinel
     *
     * @return void
     */
    public function __construct(SentinelAuth $sentinel)
    {
        $this->sentinel = $sentinel;
    }

    /**
     * Check a user's credentials.
     *
     * @param array  $credentials
     *
     * @return mixed
     */
    public function byCredentials(array $credentials)
    {
        return $this->sentinel->stateless($credentials);
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
        if ($user = $this->sentinel->getUserRepository()->findById($id)) {
            $this->sentinel->setUser($user);

            return true;
        }

        return false;
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Cartalyst\Sentinel\Users\UserInterface
     */
    public function user()
    {
        return $this->sentinel->getUser();
    }
}
