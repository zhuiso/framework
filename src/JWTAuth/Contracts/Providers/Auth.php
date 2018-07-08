<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth\Contracts\Providers;

/**
 * Interface Auth.
 */
interface Auth
{
    /**
     * Check a user's credentials.
     *
     * @param array  $credentials
     *
     * @return mixed
     */
    public function byCredentials(array $credentials);

    /**
     * Authenticate a user via the id.
     *
     * @param mixed  $id
     *
     * @return mixed
     */
    public function byId($id);

    /**
     * Get the currently authenticated user.
     *
     * @return mixed
     */
    public function user();
}
