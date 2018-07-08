<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth\Contracts;

/**
 * Interface Validator.
 */
interface Validator
{
    /**
     * Perform some checks on the value.
     *
     * @param mixed $value
     *
     * @return void
     */
    public function check($value);

    /**
     * Helper function to return a boolean.
     *
     * @param array $value
     *
     * @return bool
     */
    public function isValid($value);
}
