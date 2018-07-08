<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image;

use Closure;

/**
 * Class ImageManagerStatic.
 */
class ImageManagerStatic
{
    /**
     * Instance of Zs\Foundation\Image\ImageManager
     *
     * @var ImageManager
     */
    public static $manager;

    /**
     * ImageManagerStatic constructor.
     *
     * @param \Zs\Foundation\Image\ImageManager|null $manager
     */
    public function __construct(ImageManager $manager = null)
    {
        self::$manager = $manager ? $manager : new ImageManager();
    }

    /**
     * Get or create new ImageManager instance
     *
     * @return ImageManager
     */
    public static function getManager()
    {
        return self::$manager ? self::$manager : new ImageManager();
    }

    /**
     * Statically create new custom configured image manager
     *
     * @param array $config
     *
     * @return \Zs\Foundation\Image\ImageManager
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function configure(array $config = [])
    {
        return self::$manager = self::getManager()->configure($config);
    }

    /**
     * Statically initiates an Image instance from different input types
     *
     * @param mixed $data
     *
     * @return \Zs\Foundation\Image\Image
     */
    public static function make($data)
    {
        return self::getManager()->make($data);
    }

    /**
     * Statically creates an empty image canvas
     *
     * @param int   $width
     * @param int   $height
     * @param mixed $background
     *
     * @return \Zs\Foundation\Image\Image
     */
    public static function canvas($width, $height, $background = null)
    {
        return self::getManager()->canvas($width, $height, $background);
    }

    /**
     * Create new cached image and run callback statically
     *
     * @param Closure $callback
     * @param int     $lifetime
     * @param bool    $returnObj
     *
     * @return mixed
     */
    public static function cache(Closure $callback, $lifetime = null, $returnObj = false)
    {
        return self::getManager()->cache($callback, $lifetime, $returnObj);
    }
}
