<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Console\Commands;

use Zs\Foundation\Console\Abstracts\Command;

/**
 * Class OPcacheClearCommand.
 */
class OPcacheClearCommand extends Command
{
    /**
     * @var string
     */
    protected $prefix = '';

    /**
     * OPcacheStatusCommand constructor.
     *
     * @param null $name
     */
    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->prefix = function_exists('opcache_reset') ? 'opcache_' : (function_exists('accelerator_reset') ? 'accelerator_' : '');
    }

    /**
     * Configure Command.
     */
    public function configure()
    {
        $this->setDescription('Clear OPcache.');
        $this->setName('opcache:clear');
    }

    /**
     * Command Handler.
     */
    public function handle()
    {
        if (function_exists($this->prefix . 'reset')) {
            call_user_func($this->prefix . 'reset');
        }
        $this->output->writeln('<info>Done!</info>');
    }
}
