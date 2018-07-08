<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth\Signers\OpenSSL;

use Namshi\JOSE\Signer\OpenSSL\ES384 as NamshiES384;

/**
 * Class ES384.
 */
class ES384 extends NamshiES384
{
    /**
     * ES384 constructor.
     */
    public function __construct()
    {
    }
}
