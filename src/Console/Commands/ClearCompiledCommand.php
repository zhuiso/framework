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
 * Class ClearCompiledCommand.
 */
class ClearCompiledCommand extends Command
{
    /**
     * @var string
     */
    protected $name = 'clear-compiled';

    /**
     * @var string
     */
    protected $description = 'Remove the compiled class file';

    /**
     * Command handler.
     */
    public function handle()
    {
        $servicesPath = $this->laravel->getCachedServicesPath();
        if (file_exists($servicesPath)) {
            @unlink($servicesPath);
        }
        $this->info('The compiled class file has been removed.');
    }
}
