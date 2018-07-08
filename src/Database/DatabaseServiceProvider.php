<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Database;

use Illuminate\Database\DatabaseServiceProvider as IlluminateDatabaseServiceProvider;

/**
 * Class DatabaseServiceProvider.
 */
class DatabaseServiceProvider extends IlluminateDatabaseServiceProvider
{
    /**
     * Boot service provider.
     */
    public function boot()
    {
        Model::setConnectionResolver($this->app['db']);
        Model::setEventDispatcher($this->app['events']);
    }
}
