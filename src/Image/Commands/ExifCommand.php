<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Commands;

use Zs\Foundation\Image\Exceptions\NotSupportedException;

/**
 * Class ExifCommand.
 */
class ExifCommand extends AbstractCommand
{
    /**
     * @param \Zs\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        if (!function_exists('exif_read_data')) {
            throw new NotSupportedException('Reading Exif data is not supported by this PHP installation.');
        }
        $key = $this->argument(0)->value();
        // try to read exif data from image file
        $data = @exif_read_data($image->dirname . '/' . $image->basename);
        if (!is_null($key) && is_array($data)) {
            $data = array_key_exists($key, $data) ? $data[$key] : false;
        }
        $this->setOutput($data);

        return true;
    }
}
