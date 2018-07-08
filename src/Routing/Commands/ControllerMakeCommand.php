<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Routing\Commands;

use Carbon\Carbon;
use Illuminate\Routing\Console\ControllerMakeCommand as IlluminateControllerMakeCommand;

/**
 * Class ControllerMakeCommand.
 */
class ControllerMakeCommand extends IlluminateControllerMakeCommand
{
    /**
     * Get stub file.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('resource')) {
            return __DIR__ . '/../../../stubs/routes/controller.stub';
        }

        return __DIR__ . '/../../../stubs/routes/controller.plain.stub';
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param string $stub
     * @param string $name
     *
     * @return mixed
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        return str_replace('DummyDatetime', Carbon::now()->toDateTimeString(), $stub);
    }
}
