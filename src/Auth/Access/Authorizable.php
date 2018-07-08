<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Auth\Access;

use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Class Authorizable.
 */
trait Authorizable
{
    /**
     * Determine if the entity has a given ability.
     *
     * @param       $ability
     * @param array $arguments
     *
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function can($ability, $arguments = [])
    {
        return app(Gate::class)->forUser($this)->check($ability, $arguments);
    }

    /**
     * Determine if the entity does not have a given ability.
     *
     * @param       $ability
     * @param array $arguments
     *
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function cant($ability, $arguments = [])
    {
        return !$this->can($ability, $arguments);
    }

    /**
     * Determine if the entity does not have a given ability.
     *
     * @param       $ability
     * @param array $arguments
     *
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function cannot($ability, $arguments = [])
    {
        return $this->cant($ability, $arguments);
    }
}
