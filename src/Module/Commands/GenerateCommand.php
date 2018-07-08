<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Module\Commands;

use Zs\Foundation\Console\Abstracts\Command;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class GenerateCommand.
 */
class GenerateCommand extends Command
{
    /**
     * Configure command.
     */
    public function configure()
    {
        $this->addArgument('name', InputArgument::REQUIRED, 'The name of module.');
        $this->setDescription('To generate a module from template.');
        $this->setName('module:generate');
    }

    /**
     * Command handler.
     *
     * @return bool
     */
    public function handle(): bool
    {
        return true;
    }
}
