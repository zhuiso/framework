<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Notification\Abstracts;

use Illuminate\Notifications\Notification;

/**
 * Class NotificationType.
 */
abstract class NotificationType extends Notification
{
    /**
     * @var array
     */
    protected $attributes;

    /**
     * NotificationType constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    abstract public function via($notifiable);
}
