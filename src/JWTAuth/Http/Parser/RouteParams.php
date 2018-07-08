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

class RouteParams implements ParserContract
{
    use KeyTrait;

    /**
     * Try to get the token from the route parameters.
     *
     * @param \Illuminate\Http\Request  $request
     *
     * @return null|string
     */
    public function parse(Request $request)
    {
        $route = $request->route();

        // Route may not be an instance of Illuminate\Routing\Route
        // (it's an array in Lumen <5.2) or not exist at all
        // (if the request was never dispatched)
        if (is_callable([$route, 'parameter'])) {
            return $route->parameter($this->key);
        }
    }
}
