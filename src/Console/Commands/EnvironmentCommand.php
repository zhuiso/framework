<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class EnvironmentCommand.
 */
class EnvironmentCommand extends Command
{
    /**
     * @var string
     */
    protected $name = 'env';

    /**
     * @var string
     */
    protected $description = 'Display the current framework environment';

    /**
     * Command handler.
     */
    public function handle()
    {
        $this->line('<info>Current application environment:</info> <comment>' . $this->laravel['env'] . '</comment>');
    }
}
