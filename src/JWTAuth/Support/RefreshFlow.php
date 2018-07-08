<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth\Support;

/**
 * Trait RefreshFlow.
 */
trait RefreshFlow
{
    /**
     * The refresh flow flag.
     *
     * @var bool
     */
    protected $refreshFlow = false;

    /**
     * Set the refresh flow flag.
     *
     * @param bool  $refreshFlow
     *
     * @return $this
     */
    public function setRefreshFlow($refreshFlow = true)
    {
        $this->refreshFlow = $refreshFlow;

        return $this;
    }
}
