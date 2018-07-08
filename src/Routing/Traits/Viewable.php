<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Routing\Traits;

use Illuminate\Support\Str;

/**
 * Trait Viewable.
 */
trait Viewable
{
    /**
     * Share variable with view.
     *
     * @param      $key
     * @param null $value
     */
    protected function share($key, $value = null)
    {
        $this->view->share($key, $value);
    }

    /**
     * Share variable with view.
     *
     * @param       $template
     * @param array $data
     * @param array $mergeData
     *
     * @return \Illuminate\Contracts\View\View
     */
    protected function view($template, array $data = [], $mergeData = [])
    {
        if (Str::contains($template, '::')) {
            return $this->view->make($template, $data, $mergeData);
        } else {
            return $this->view->make('theme::' . $template, $data, $mergeData);
        }
    }
}
