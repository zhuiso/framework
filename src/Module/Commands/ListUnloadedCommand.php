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
 * Class ListUnloadedCommand.
 */
class ListUnloadedCommand extends Command
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
        $this->setDescription('Show unloaded module list.');
        $this->setName('module:unloaded');
    }

    /**
     * @param \Zs\Foundation\Module\ModuleManager $manager
     *
     * @return bool
     */
    public function handle(ModuleManager $manager)
    {
        $modules = $manager->repository()->filter(function (Module $module) {
            return $module->get('loaded') == false;
        });
        $list = new Collection();
        $this->info('Modules list:');
        $modules->each(function (array $module) use ($list) {
            $data = collect($module['authors']);
            $author = $data->get('name');
            $data->has('email') ? $author .= ' <' . $data->get('email') . '>' : null;
            $list->push([
                $module['identification'],
                $author,
                $module['description'],
                $module['directory'],
                $module['provider'],
                'Normal'
            ]);
        });
        $this->table($this->headers, $list->toArray());

        return true;
    }
}
