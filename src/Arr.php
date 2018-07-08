<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation;

use Illuminate\Support\Arr as IlluminateArr;

/**
 * Class Arr.
 */
class Arr extends IlluminateArr
{
    /**
     * @param callable $callback
     * @param array    $array
     */
    public static function each(callable $callback, array $array)
    {
        foreach ($array as $key => $item) {
            if ($callback($item, $key) === false) {
                break;
            }
        }
    }

    /**
     * @param callable $callback
     * @param array    $array
     *
     * @return array
     */
    public static function map(callable $callback, array $array)
    {
        $keys = array_keys($array);
        $items = array_map($callback, $array, $keys);

        return array_combine($keys, $items);
    }
}
