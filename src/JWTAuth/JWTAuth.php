<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth;

use Zs\Foundation\JWTAuth\Http\Parser\Parser;
use Zs\Foundation\JWTAuth\Contracts\Providers\Auth;

/**
 * Class JWTAuth.
 */
class JWTAuth extends JWT
{
    /**
     * The authentication provider.
     *
     * @var \Zs\Foundation\JWTAuth\Contracts\Providers\Auth
     */
    protected $auth;

    /**
     * JWTAuth constructor.
     *
     * @param \Zs\Foundation\JWTAuth\Manager                  $manager
     * @param \Zs\Foundation\JWTAuth\Contracts\Providers\Auth $auth
     * @param \Zs\Foundation\JWTAuth\Http\Parser\Parser       $parser
     */
    public function __construct(Manager $manager, Auth $auth, Parser $parser)
    {
        parent::__construct($manager, $parser);
        $this->auth = $auth;
    }

    /**
     * Attempt to authenticate the user and return the token.
     *
     * @param array  $credentials
     *
     * @return false|string
     */
    public function attempt(array $credentials)
    {
        if (! $this->auth->byCredentials($credentials)) {
            return false;
        }

        return $this->fromUser($this->user());
    }

    /**
     * Authenticate a user via a token.
     *
     * @return \Zs\Foundation\JWTAuth\Contracts\JWTSubject|false
     */
    public function authenticate()
    {
        $id = $this->getPayload()->get('sub');

        if (! $this->auth->byId($id)) {
            return false;
        }

        return $this->user();
    }

    /**
     * Alias for authenticate().
     *
     * @return \Zs\Foundation\JWTAuth\Contracts\JWTSubject|false
     */
    public function toUser()
    {
        return $this->authenticate();
    }

    /**
     * Get the authenticated user.
     *
     * @return \Zs\Foundation\JWTAuth\Contracts\JWTSubject
     */
    public function user()
    {
        return $this->auth->user();
    }
}
