<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth\Support;

use Carbon\Carbon;

/**
 * Class Utils.
 */
class Utils
{
    /**
     * Get the Carbon instance for the current time.
     *
     * @return \Carbon\Carbon
     */
    public static function now()
    {
        return Carbon::now('UTC');
    }

    /**
     * Get the Carbon instance for the timestamp.
     *
     * @param int  $timestamp
     *
     * @return \Carbon\Carbon
     */
    public static function timestamp($timestamp)
    {
        return Carbon::createFromTimestampUTC($timestamp)->timezone('UTC');
    }

    /**
     * Checks if a timestamp is in the past.
     *
     * @param int  $timestamp
     *
     * @return bool
     */
    public static function isPast($timestamp)
    {
        return static::timestamp($timestamp)->isPast();
    }

    /**
     * Checks if a timestamp is in the future.
     *
     * @param int  $timestamp
     *
     * @return bool
     */
    public static function isFuture($timestamp)
    {
        return static::timestamp($timestamp)->isFuture();
    }
}
