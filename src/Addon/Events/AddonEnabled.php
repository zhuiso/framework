<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Addon\Events;

use Zs\Foundation\Addon\Addon;

/**
 * Class ExtensionEnabled.
 */
class AddonEnabled
{
    /**
     * @var \Zs\Foundation\Addon\AddonManager
     */
    protected $manager;

    /**
     * ExtensionEnabled constructor.
     *
     * @param \Zs\Foundation\Addon\Addon $extension
     *
     * @internal param \Illuminate\Container\Container|\Illuminate\Contracts\Foundation\Application|\Zs\Foundation\Application $container
     * @internal param \Zs\Foundation\Addon\ExtensionManager $manager
     */
    public function __construct(Addon $extension)
    {
        $this->extension = $extension;
    }
}
