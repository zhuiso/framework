<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Member;

use Zs\Foundation\Http\Abstracts\ServiceProvider;

/**
 * Class MemberServiceProvider.
 */
class MemberServiceProvider extends ServiceProvider
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
        return [
            'member',
            'member.manager',
        ];
    }

    /**
     * Register for service provider.
     */
    public function register()
    {
        $this->app->singleton('member', function () {
            return new MemberManagement();
        });
        $this->app->singleton('member.manager', function () {
            $manager = $this->app->make('member');

            return $manager->manager();
        });
    }
}
