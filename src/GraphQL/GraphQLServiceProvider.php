<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\GraphQL;

use Zs\Foundation\Http\Abstracts\ServiceProvider;

/**
 * Class GraphQLServiceProvider.
 */
class GraphQLServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * @return array
     */
    public function provides()
    {
        return ['graphql'];
    }

    /**
     * Register Service Provider.
     */
    public function register()
    {
        $this->app->singleton('graphql', function ($app) {
            $manager = new GraphQLManager();
            foreach ($app['config']['graphql']['types'] as $type) {
                $manager->addType($type);
            }
            foreach ($app['config']['graphql']['schemas'] as $name => $definition) {
                $manager->addSchema($name, $definition);
            }

            return $manager;
        });
    }
}
