<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth\Http\Parser;

use Illuminate\Http\Request;
use Zs\Foundation\JWTAuth\Contracts\Http\Parser as ParserContract;

class Cookies implements ParserContract
{
    use KeyTrait;

    /**
     * Try to parse the token from the request cookies.
     *
     * @param \Illuminate\Http\Request  $request
     *
     * @return null|string
     */
    public function parse(Request $request)
    {
        return $request->cookie($this->key);
    }
}
