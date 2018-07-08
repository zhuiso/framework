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
 * Class UpCommand.
 */
class UpCommand extends Command
{
    /**
     * @var string
     */
    protected $name = 'up';
    /**
     * @var string
     */
    protected $description = 'Bring the application out of maintenance mode';

    /**
     * Command handler.
     */
    public function handle()
    {
        @unlink($this->laravel->storagePath() . '/bootstraps/down');
        $this->info('Application is now live.');
    }
}
