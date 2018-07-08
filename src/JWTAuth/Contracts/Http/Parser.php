<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth\Contracts\Http;

use Illuminate\Http\Request;

/**
 * Interface Parser.
 */
interface Parser
{
    /**
     * Parse the request.
     *
     * @param \Illuminate\Http\Request  $request
     *
     * @return null|string
     */
    public function parse(Request $request);
}
