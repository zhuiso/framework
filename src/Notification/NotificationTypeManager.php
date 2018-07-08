<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Notification;

use Illuminate\Support\Collection;
use Zs\Foundation\Notification\Abstracts\NotificationType;

/**
 * Class NotificationTypeManager.
 */
class NotificationTypeManager
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $types;

    /**
     * NotificationTypeManager constructor.
     */
    public function __construct()
    {
        $this->types = new Collection();
    }

    /**
     * @param                                                                 $identification
     * @param \Zs\Foundation\Notification\Abstracts\NotificationType|null $type
     *
     * @return \Zs\Foundation\Notification\Abstracts\NotificationType
     */
    public function type($identification, NotificationType $type = null)
    {
        if (is_null($type) && $this->types->has($identification)) {
            return $this->types->get($identification);
        } else {
            $this->types->put($identification, $type);

            return $type;
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function types()
    {
        return $this->types;
    }
}
