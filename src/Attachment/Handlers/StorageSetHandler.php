<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Attachment\Handlers;

use Illuminate\Container\Container;
use Zs\Foundation\Routing\Abstracts\Handler;
use Zs\Foundation\Setting\Contracts\SettingsRepository;

/**
 * Class StorageSetHandler.
 */
class StorageSetHandler extends Handler
{
    /**
     * @var \Zs\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    /**
     * StorageSetHandler constructor.
     *
     * @param \Illuminate\Container\Container                         $container
     * @param \Zs\Foundation\Setting\Contracts\SettingsRepository $settings
     */
    public function __construct(Container $container, SettingsRepository $settings)
    {
        parent::__construct($container);
        $this->settings = $settings;
    }

    /**
     * Execute Handler.
     */
    public function execute()
    {
        $this->settings->set('storage.default', $this->request->get('default'));
        $this->withCode(200)->withMessage('修改设置成功!');
    }
}
