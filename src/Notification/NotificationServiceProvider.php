<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Notification;

use Illuminate\Notifications\NotificationServiceProvider as IlluminateNotificationServiceProvider;
use Zs\Foundation\Notification\Types\CommonType;

/**
 * Class NotificationServiceProvider.
 */
class NotificationServiceProvider extends IlluminateNotificationServiceProvider
{
    /**
     * @var \Zs\Foundation\Application
     */
    protected $app;

    /**
     * Boot the application services.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'notifications');
        $this->app->make(NotificationTypeManager::class)->type('common', new CommonType([]));
    }

    /**
     * Register for service provider.
     */
    public function register()
    {
        parent::register();
        $this->app->singleton('notification.type', function () {
            return new NotificationTypeManager();
        });
    }
}
