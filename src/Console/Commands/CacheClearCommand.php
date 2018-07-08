<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Cache\Commands;

use Illuminate\Console\Command;
use Zs\Foundation\Cache\Queues\FlushAll;

/**
 * Class RouteClearCommand.
 */
class CacheClearCommand extends Command
{
    /**
     * @var string
     */
    protected $name = 'cache:clear';

    /**
     * @var string
     */
    protected $description = 'Clear the zs cache';

    /**
     * RouteClearCommand constructor.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Command handler.
     */
    public function handle()
    {
        FlushAll::dispatch();
        $this->info('Zs cache cleared!');
    }
}
