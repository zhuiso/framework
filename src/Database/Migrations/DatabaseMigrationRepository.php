<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Database\Migrations;

use Illuminate\Database\Migrations\DatabaseMigrationRepository as IlluminateDatabaseMigrationRepository;

/**
 * Class DatabaseMigrationRepository.
 */
class DatabaseMigrationRepository extends IlluminateDatabaseMigrationRepository
{
    /**
     * Get the last migration batch on path.
     *
     * @param $files
     *
     * @return array
     */
    public function getLastOnPath($files)
    {
        $query = $this->table()->whereIn('migration', $files);

        return $query->orderBy('migration', 'desc')->get()->all();
    }
}
