<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth\Claims;

use DateInterval;
use DateTimeInterface;
use Zs\Foundation\JWTAuth\Support\Utils;
use Zs\Foundation\JWTAuth\Exceptions\InvalidClaimException;

/**
 * Trait DatetimeTrait.
 */
trait DatetimeTrait
{
    /**
     * Set the claim value, and call a validate method.
     *
     * @param mixed $value
     *
     * @throws \Zs\Foundation\JWTAuth\Exceptions\InvalidClaimException
     *
     * @return $this
     */
    public function setValue($value)
    {
        if ($value instanceof DateInterval) {
            $value = Utils::now()->add($value);
        }
        if ($value instanceof DateTimeInterface) {
            $value = $value->getTimestamp();
        }

        return parent::setValue($value);
    }

    /**
     * @param $value
     *
     * @return mixed
     * @throws \Zs\Foundation\JWTAuth\Exceptions\InvalidClaimException
     */
    public function validateCreate($value)
    {
        if (!is_numeric($value)) {
            throw new InvalidClaimException($this);
        }

        return $value;
    }

    /**
     * Determine whether the value is in the future.
     *
     * @param mixed $value
     *
     * @return bool
     */
    protected function isFuture($value)
    {
        return Utils::isFuture($value);
    }

    /**
     * Determine whether the value is in the past.
     *
     * @param mixed $value
     *
     * @return bool
     */
    protected function isPast($value)
    {
        return Utils::isPast($value);
    }
}
