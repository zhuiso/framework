<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Contracts;

/**
 * Interface Detector.
 */
interface Detector
{
    /**
     * Detect paths.
     *
     * @param string $path
     * @param string $namespace
     *
     * @return array
     */
    public function detect(string $path, string $namespace);

    /**
     * Do.
     *
     * @param $target
     */
    public function do($target);

    /**
     * Paths definition.
     *
     * @return array
     */
    public function paths();
}
