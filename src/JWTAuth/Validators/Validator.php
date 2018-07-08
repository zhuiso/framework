<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth\Validators;

use Zs\Foundation\JWTAuth\Support\RefreshFlow;
use Zs\Foundation\JWTAuth\Exceptions\JWTException;
use Zs\Foundation\JWTAuth\Contracts\Validator as ValidatorContract;

/**
 * Class Validator.
 */
abstract class Validator implements ValidatorContract
{
    use RefreshFlow;

    /**
     * Helper function to return a boolean.
     *
     * @param array  $value
     *
     * @return bool
     */
    public function isValid($value)
    {
        try {
            $this->check($value);
        } catch (JWTException $e) {
            return false;
        }

        return true;
    }

    /**
     * Run the validation.
     *
     * @param array  $value
     *
     * @return void
     */
    abstract public function check($value);
}
