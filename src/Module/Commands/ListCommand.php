<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Module\Commands;

use Illuminate\Support\Collection;
use Zs\Foundation\Console\Abstracts\Command;
use Zs\Foundation\Module\Module;
use Zs\Foundation\Module\ModuleManager;

/**
 * Class ListCommand.
 */
class ListCommand extends Command
{
    /**
     * @var array
     */
    protected $headers = [
        'Module Name',
        'Author',
        'Description',
        'Module Path',
        'Entry',
        'Status',
    ];

    /**
     * Configure Command.
     */
    public function configure()
    {
        $this->setDescription('Show module list.');
        $this->setName('module:list');
    }

    /**
     * Command Handler.
     *
     * @param \Zs\Foundation\Module\ModuleManager $manager
     *
     * @return bool
     */
    public function handle(ModuleManager $manager): bool
    {
        $modules = $manager->repository();
        $list = new Collection();
        $this->info('Modules list:');
        $modules->each(function (Module $module, $path) use ($list) {
            $list->push([
                $module->identification(),
                collect($module->author())->first(),
                $module->description(),
                $path,
                $module->service(),
                'Normal',
            ]);
        });
        $this->table($this->headers, $list->toArray());

        return true;
    }
}