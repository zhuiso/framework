<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Flow\Contracts;

use Zs\Foundation\Flow\Flow;

/**
 * Interface SupportStrategy.
 */
interface SupportStrategy
{
    /**
     * @param Flow   $workflow
     * @param object $subject
     *
     * @return bool
     */
    public function supports(Flow $workflow, $subject);
}
