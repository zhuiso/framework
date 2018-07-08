<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth\Exceptions;

use Exception;

/**
 * Class JWTException.
 */
class JWTException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'An error occurred';
}
