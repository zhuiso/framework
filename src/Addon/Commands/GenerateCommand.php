<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Addon\Commands;

use Zs\Foundation\Console\Abstracts\Command;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class GenerateCommand.
 */
class GenerateCommand extends Command
{
    /**
     * Configure Command.
     */
    public function configure()
    {
        $this->addArgument('name', InputArgument::REQUIRED, 'The name of a extension.');
        $this->setDescription('To generate a extension from template.');
        $this->setName('extension:generate');
    }

    /**
     * Command handler.
     *
     * @return bool
     */
    public function handle()
    {
        return true;
    }
}
