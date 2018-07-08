<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth\Signers\OpenSSL;

use Namshi\JOSE\Signer\OpenSSL\ES512 as NamshiES512;

/**
 * Class ES512.
 */
class ES512 extends NamshiES512
{
    /**
     * ES512 constructor.
     */
    public function __construct()
    {
    }
}
