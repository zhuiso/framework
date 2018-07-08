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
use Zs\Foundation\JWTAuth\Claims\Claim;

/**
 * Class InvalidClaimException.
 */
class InvalidClaimException extends JWTException
{
    /**
     * InvalidClaimException constructor.
     *
     * @param \Zs\Foundation\JWTAuth\Claims\Claim $claim
     * @param int                                     $code
     * @param \Exception|null                         $previous
     */
    public function __construct(Claim $claim, $code = 0, Exception $previous = null)
    {
        parent::__construct('Invalid value provided for claim [' . $claim->getName() . ']', $code, $previous);
    }
}
