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
 * Interface JWT.
 */
interface JWT
{
    /**
     * @param array  $payload
     *
     * @return string
     */
    public function encode(array $payload);

    /**
     * @param string  $token
     *
     * @return array
     */
    public function decode($token);
}
