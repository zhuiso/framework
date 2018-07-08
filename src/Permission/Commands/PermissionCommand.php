<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Permission\Commands;

use Illuminate\Support\Collection;
use Zs\Foundation\Console\Abstracts\Command;
use Zs\Foundation\Permission\Permission;

/**
 * Class PermissionCommand.
 */
class PermissionCommand extends Command
{
    /**
     * @var array
     */
    protected $headers = [
        'Identification',
        'Description',
    ];

    /**
     * Configure Command.
     */
    public function configure()
    {
        $this->setDescription('Show permission list.');
        $this->setName('permission:list');
    }

    /**
     * Command Handler.
     *
     * @return bool
     */
    public function handle()
    {
        $data = new Collection();
        $this->container->make('permission')->permissions()->each(function (Permission $permission, $identification) use ($data) {
            $data->push([
                $identification,
                $permission->description(),
            ]);
        });
        $this->table($this->headers, $data->toArray());

        return true;
    }
}
