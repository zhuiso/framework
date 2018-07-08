<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Console;

use Illuminate\Contracts\Console\Kernel as KernelContract;

/**
 * Class QueuedJob.
 */
class QueuedJob
{
    /**
     * @var \Illuminate\Contracts\Console\Kernel
     */
    protected $kernel;

    /**
     * QueuedJob constructor.
     *
     * @param \Illuminate\Contracts\Console\Kernel $kernel
     */
    public function __construct(KernelContract $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Command handler.
     *
     * @param \Illuminate\Queue\Jobs\Job $job
     * @param array                      $data
     *
     * @return void
     */
    public function fire($job, $data)
    {
        call_user_func_array([
            $this->kernel,
            'call',
        ], $data);
        $job->delete();
    }
}
