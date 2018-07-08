<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth\Claims;

use Zs\Foundation\JWTAuth\Exceptions\TokenExpiredException;

/**
 * Class Expiration.
 */
class Expiration extends Claim
{
    use DatetimeTrait;

    /**
     * @var string
     */
    protected $name = 'exp';

    /**
     * @throws \Zs\Foundation\JWTAuth\Exceptions\TokenExpiredException
     */
    public function validatePayload()
    {
        if ($this->isPast($this->getValue())) {
            throw new TokenExpiredException('Token has expired');
        }
    }
}
