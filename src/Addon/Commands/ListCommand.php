<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Addon\Commands;

use Illuminate\Support\Collection;
use Zs\Foundation\Console\Abstracts\Command;
use Zs\Foundation\Addon\Addon;
use Zs\Foundation\Addon\AddonManager;
use Zs\Foundation\Setting\Contracts\SettingsRepository;

/**
 * Class ListCommand.
 */
class ListCommand extends Command
{
    /**
     * @var array
     */
    protected $headers = [
        'Extension Name',
        'Author',
        'Description',
        'Extension Path',
        'Entry',
        'Status',
    ];

    /**
     * Configure Command.
     */
    public function configure()
    {
        $this->setDescription('Show extension list.');
        $this->setName('extension:list');
    }

    /**
     * Command Handler.
     *
     * @return bool
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $addons = $this->addon->repository();
        $list = new Collection();
        $this->info('Extensions list:');
        $addons->each(function (Addon $addon) use ($list) {
            $data = collect(collect($addon->get('author'))->first());
            $author = $data->get('name');
            $data->has('email') ? $author .= ' <' . $data->get('email') . '>' : null;
            $list->push([
                $addon->identification(),
                $author,
                $addon->get('description'),
                $addon->get('directory'),
                $addon->provider(),
                'Normal',
            ]);
        });
        $this->table($this->headers, $list->toArray());

        return true;
    }
}
