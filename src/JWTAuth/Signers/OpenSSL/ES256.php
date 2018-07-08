<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth\Signers\OpenSSL;

use Namshi\JOSE\Signer\OpenSSL\ES256 as NamshiES256;

/**
 * Class ES256.
 */
class ES256 extends NamshiES256
{
    /**
     * ES256 constructor.
     */
    public function __construct()
    {
    }
}
