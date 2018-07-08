<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Middlewares;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Zs\Foundation\Http\Exceptions\MaintenanceModeException;

/**
 * Class CheckForMaintenanceMode.
 */
class CheckForMaintenanceMode
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application|\Zs\Foundation\Application
     */
    protected $application;

    /**
     * CheckForMaintenanceMode constructor.
     *
     * @param \Illuminate\Contracts\Foundation\Application|\Zs\Foundation\Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->application->isDownForMaintenance()) {
            $data = json_decode(file_get_contents($this->application->storagePath() . '/bootstraps/down'), true);
            throw new MaintenanceModeException($data['time'], $data['retry'], $data['message']);
        }

        return $next($request);
    }
}
