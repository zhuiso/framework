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
use Illuminate\Routing\Console\MiddlewareMakeCommand as IlluminateMiddlewareMakeCommand;

/**
 * Class MiddlewareMakeCommand.
 */
class MiddlewareMakeCommand extends IlluminateMiddlewareMakeCommand
{
    /**
     * Get stub file.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../../../stubs/routes/middleware.stub';
    }

    /**
     * Replace class name by holder.
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
