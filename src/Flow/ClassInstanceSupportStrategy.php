<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Flow;

use Zs\Foundation\Flow\Contracts\SupportStrategy;

/**
 * Class ClassInstanceSupportStrategy.
 */
class ClassInstanceSupportStrategy implements SupportStrategy
{
    /**
     * @var string
     */
    private $className;

    /**
     * @param string $className a FQCN
     */
    public function __construct($className)
    {
        $this->className = $className;
    }

    /**
     * @param Flow   $workflow
     * @param object $subject
     *
     * @return bool
     */
    public function supports(Flow $workflow, $subject)
    {
        return $subject instanceof $this->className;
    }
}
