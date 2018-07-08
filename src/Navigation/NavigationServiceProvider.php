<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Navigation;

use Zs\Foundation\Http\Abstracts\ServiceProvider;
use Zs\Foundation\Navigation\Models\Item;
use Zs\Foundation\Navigation\Observers\ItemObserver;

/**
 * Class NavigationServiceProvider.
 */
class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Boot service provider.
     */
    public function boot()
    {
        Item::observe(ItemObserver::class);
    }
}
