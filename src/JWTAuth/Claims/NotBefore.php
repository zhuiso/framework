<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth\Claims;

use Zs\Foundation\JWTAuth\Exceptions\InvalidClaimException;
use Zs\Foundation\JWTAuth\Exceptions\TokenInvalidException;

/**
 * Class NotBefore.
 */
class NotBefore extends Claim
{
    use DatetimeTrait;

    /**
     * @var string
     */
    protected $name = 'nbf';

    /**
     * @param mixed $value
     *
     * @return mixed
     * @throws \Zs\Foundation\JWTAuth\Exceptions\InvalidClaimException
     */
    public function validateCreate($value)
    {
        if (!is_numeric($value) || $this->isFuture($value)) {
            throw new InvalidClaimException($this);
        }

        return $value;
    }

    /**
     * @throws \Zs\Foundation\JWTAuth\Exceptions\TokenInvalidException
     */
    public function validatePayload()
    {
        if ($this->isFuture($this->getValue())) {
            throw new TokenInvalidException('Not Before (nbf) timestamp cannot be in the future');
        }
    }
}
