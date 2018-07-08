<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Member\Events;

use Zs\Foundation\Member\Member;

/**
 * Class MemberUpdated.
 */
class MemberUpdated
{
    /**
     * @var \Zs\Foundation\Member\Member
     */
    protected $member;

    /**
     * MemberUpdated constructor.
     *
     * @param \Zs\Foundation\Member\Member $member
     *
     * @internal param \Illuminate\Container\Container $container
     */
    public function __construct(Member $member)
    {
        $this->member = $member;
    }
}
