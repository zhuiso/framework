<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Module\Handlers;

use Illuminate\Container\Container;
use Zs\Foundation\Module\ModuleManager;
use Zs\Foundation\Routing\Abstracts\Handler;

/**
 * Class UpdateHandler.
 */
class UpdateHandler extends Handler
{
    /**
     * @var \Zs\Foundation\Module\ModuleManager
     */
    protected $manager;

    /**
     * UpdateHandler constructor.
     *
     * @param \Illuminate\Container\Container         $container
     * @param \Zs\Foundation\Module\ModuleManager $manager
     */
    public function __construct(Container $container, ModuleManager $manager)
    {
        parent::__construct($container);
        $this->manager = $manager;
    }

    /**
     * Execute Handler.
     */
    public function execute()
    {
        $module = $this->manager->get($this->request->input('name'));
        if ($module && method_exists($provider = $module->service(), 'update') && call_user_func([
                $provider,
                'update',
            ])
        ) {
            $this->withCode(200)->withMessage('升级模块成功！');
        } else {
            $this->withCode(500)->withError('升级模块失败！');
        }
    }
}
