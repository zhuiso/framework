<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Permission\Middlewares;

use Closure;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Http\Request;
use Zs\Foundation\Database\Model;
use Zs\Foundation\Member\Member;
use Zs\Foundation\Permission\Exceptions\PermissionException;
use Zs\Foundation\Permission\PermissionManager;

/**
 * Class Permission.
 */
class Permission
{
    /**
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * @var \Zs\Foundation\Permission\PermissionManager
     */
    protected $permission;

    /**
     * Permission constructor.
     *
     * @param \Illuminate\Contracts\Auth\Factory              $auth
     * @param \Zs\Foundation\Permission\PermissionManager $permission
     */
    public function __construct(Factory $auth, PermissionManager $permission)
    {
        $this->auth = $auth;
        $this->permission = $permission;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string                   $identification
     *
     * @return mixed
     * @throws \Zs\Foundation\Permission\Exceptions\PermissionException
     */
    public function handle(Request $request, Closure $next, $identification = '')
    {
        $action = $request->route()->getAction();
        if (in_array('auth:api', $action['middleware'])) {
            $user = $this->auth->guard('api')->user();
        } else {
            $user = $this->auth->guard()->user();
        }
        if ($user instanceof Model) {
            if (Member::hasMacro('groups')) {
                $user->load('groups')->getAttribute('groups');
                if (!$this->permission($identification, $user->load('groups')->getAttribute('groups'))) {
                    throw new PermissionException('Permission deny!');
                }
            }
        }

        return $next($request);
    }

    /**
     * @param $identification
     * @param $groups
     *
     * @return bool
     */
    protected function permission($identification, $groups)
    {
        foreach (collect($groups)->toArray() as $group) {
            if ($this->permission->check($identification, $group['identification'])) {
                return true;
            }
        }

        return false;
    }
}
