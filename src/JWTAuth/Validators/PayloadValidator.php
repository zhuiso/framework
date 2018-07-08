<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth\Validators;

use Zs\Foundation\JWTAuth\Claims\Collection;
use Zs\Foundation\JWTAuth\Exceptions\TokenInvalidException;

/**
 * Class PayloadValidator.
 */
class PayloadValidator extends Validator
{
    /**
     * The required claims.
     *
     * @var array
     */
    protected $requiredClaims = [
        'iss',
        'iat',
        'exp',
        'nbf',
        'sub',
        'jti',
    ];

    /**
     * The refresh TTL.
     *
     * @var int
     */
    protected $refreshTTL = 20160;

    /**
     * Run the validations on the payload array.
     *
     * @param \Zs\Foundation\JWTAuth\Claims\Collection  $value
     *
     * @return \Zs\Foundation\JWTAuth\Claims\Collection
     */
    public function check($value)
    {
        $this->validateStructure($value);

        return $this->refreshFlow ? $this->validateRefresh($value) : $this->validatePayload($value);
    }

    /**
     * Ensure the payload contains the required claims and
     * the claims have the relevant type.
     *
     * @param \Zs\Foundation\JWTAuth\Claims\Collection  $claims
     *
     * @throws \Zs\Foundation\JWTAuth\Exceptions\TokenInvalidException
     *
     * @return void
     */
    protected function validateStructure(Collection $claims)
    {
        if (! $claims->hasAllClaims($this->requiredClaims)) {
            throw new TokenInvalidException('JWT payload does not contain the required claims');
        }
    }

    /**
     * Validate the payload timestamps.
     *
     * @param \Zs\Foundation\JWTAuth\Claims\Collection  $claims
     *
     * @throws \Zs\Foundation\JWTAuth\Exceptions\TokenExpiredException
     * @throws \Zs\Foundation\JWTAuth\Exceptions\TokenInvalidException
     *
     * @return \Zs\Foundation\JWTAuth\Claims\Collection
     */
    protected function validatePayload(Collection $claims)
    {
        return $claims->validate('payload');
    }

    /**
     * Check the token in the refresh flow context.
     *
     * @param \Zs\Foundation\JWTAuth\Claims\Collection  $claims
     *
     * @throws \Zs\Foundation\JWTAuth\Exceptions\TokenExpiredException
     *
     * @return \Zs\Foundation\JWTAuth\Claims\Collection
     */
    protected function validateRefresh(Collection $claims)
    {
        return $this->refreshTTL === null ? $claims : $claims->validate('refresh', $this->refreshTTL);
    }

    /**
     * Set the required claims.
     *
     * @param array  $claims
     *
     * @return $this
     */
    public function setRequiredClaims(array $claims)
    {
        $this->requiredClaims = $claims;

        return $this;
    }

    /**
     * Set the refresh ttl.
     *
     * @param int  $ttl
     *
     * @return $this
     */
    public function setRefreshTTL($ttl)
    {
        $this->refreshTTL = $ttl;

        return $this;
    }
}
