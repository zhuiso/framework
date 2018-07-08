<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http\Bootstraps;

use Carbon\Carbon;
use Zs\Foundation\Http\Contracts\Bootstrap;
use Zs\Foundation\Http\Contracts\Detector;
//use Zs\Foundation\Http\Detectors\ListenerDetector;
use Zs\Foundation\Http\Detectors\CommandDetector;
use Zs\Foundation\Http\Detectors\SubscriberDetector;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class LoadDetect.
 */
class LoadDetection implements Bootstrap
{
    use Helpers;

    /**
     * @var array
     */
    protected $detectors = [
//        ListenerDetector::class,
        CommandDetector::class,
        SubscriberDetector::class,
    ];

    /**
     * Bootstrap the given application.
     */
    public function bootstrap()
    {
        if ($this->container->isInstalled() && $this->cache->store()->has('bootstrap.detection')) {
            $collection = $this->cache->store()->get('bootstrap.detection', collect());
        } else {
            $collection = collect();
            foreach ($this->detectors as $detector) {
                $detector = $this->container->make($detector);
                $detector instanceof Detector && collect($detector->paths())->each(function ($definition) use ($collection, $detector) {
                    collect($detector->detect($definition['path'], $definition['namespace']))->each(function ($subscriber) use ($collection) {
                        $collection->push($subscriber);
                    });
                });
            }
            $this->container->isInstalled() &&
            $this->cache->tags('zs')->put('bootstrap.detection', $collection, (new Carbon())->addHour(10));
        }
        $collection->each(function ($subscriber) {
            $this->event->subscribe($subscriber);
        });
    }
}
