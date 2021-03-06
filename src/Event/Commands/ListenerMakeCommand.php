<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Event\Commands;

use Carbon\Carbon;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class ListenerMakeCommand.
 */
class ListenerMakeCommand extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:listener';

    /**
     * @var string
     */
    protected $description = 'Create a new event listener class';

    /**
     * @var string
     */
    protected $type = 'Listener';

    /**
     * Command handler.
     *
     * @return bool
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        if (!$this->option('event')) {
            $this->error('Missing required option: --event');

            return false;
        }
        parent::handle();

        return true;
    }

    /**
     * Build the class with the given name.
     *
     * @param string $name
     *
     * @return mixed|string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);
        $event = $this->option('event');
        if (!Str::startsWith($event, $this->laravel->getNamespace()) && !Str::startsWith($event, 'Illuminate')) {
            $event = $this->laravel->getNamespace() . 'Events\\' . $event;
        }
        $stub = str_replace('DummyDatetime', Carbon::now()->toDateTimeString(), $stub);
        $stub = str_replace('DummyEvent', class_basename($event), $stub);
        $stub = str_replace('DummyFullEvent', $event, $stub);

        return $stub;
    }

    /**
     * Get stub file.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('queued')) {
            return __DIR__ . '/../../../stubs/events/listener-queued.stub';
        } else {
            return __DIR__ . '/../../../stubs/events/listener.stub';
        }
    }

    /**
     * Determine if the class already exists.
     *
     * @param string $rawName
     *
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return class_exists($rawName);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Listeners';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            [
                'event',
                null,
                InputOption::VALUE_REQUIRED,
                'The event class being listened for.',
            ],
            [
                'queued',
                null,
                InputOption::VALUE_NONE,
                'Indicates the event listener should be queued.',
            ],
        ];
    }
}
