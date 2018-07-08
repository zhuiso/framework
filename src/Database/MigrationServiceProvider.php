<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Database;

use Illuminate\Database\MigrationServiceProvider as IlluminateMigrationServiceProvider;
use Zs\Foundation\Database\Migrations\DatabaseMigrationRepository;
use Zs\Foundation\Database\Migrations\MigrationCreator;
use Zs\Foundation\Database\Migrations\Migrator;

/**
 * Class MigrationServiceProvider.
 */
class MigrationServiceProvider extends IlluminateMigrationServiceProvider
{
    /**
     * Register the migration creator.
     */
    protected function registerCreator()
    {
        $this->app->singleton('migration.creator', function ($app) {
            return new MigrationCreator($app, $app['files']);
        });
    }

    /**
     * Register the migrator service.
     */
    protected function registerMigrator()
    {
        $this->app->singleton('migrator', function ($app) {
            $repository = $app['migration.repository'];

            return new Migrator($app, $repository, $app['db'], $app['files']);
        });
    }

    /**
     * Register the migration repository service.
     *
     * @return void
     */
    protected function registerRepository()
    {
        $this->app->singleton('migration.repository', function ($app) {
            $table = $app['config']['database.migrations'];

            return new DatabaseMigrationRepository($app['db'], $table);
        });
    }
}
