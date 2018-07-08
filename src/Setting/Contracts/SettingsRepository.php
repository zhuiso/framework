<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Setting\Contracts;

/**
 * Interface SettingsRepository.
 */
interface SettingsRepository
{
    /**
     * Get all settings.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all();

    /**
     * Delete a setting value.
     *
     * @param $keyLike
     */
    public function delete($keyLike);

    /**
     * Get a setting value by key.
     *
     * @param      $key
     * @param null $default
     *
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Set a setting value from key and value.
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value);
}
