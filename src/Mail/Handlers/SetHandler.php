<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Mail\Handlers;

use Illuminate\Container\Container;
use Zs\Foundation\Routing\Abstracts\Handler;
use Zs\Foundation\Setting\Contracts\SettingsRepository;

/**
 * Class SetHandler.
 */
class SetHandler extends Handler
{
    /**
     * @var \Zs\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    /**
     * SetHandler constructor.
     *
     * @param \Illuminate\Container\Container                         $container
     * @param \Zs\Foundation\Setting\Contracts\SettingsRepository $settings
     */
    public function __construct(Container $container, SettingsRepository $settings) {
        parent::__construct($container);
        $this->settings = $settings;
    }
    /**
     * Execute Handler.
     */
    public function execute()
    {
        $this->settings->set('mail.driver', $this->request->input('driver'));
        $this->settings->set('mail.encryption', $this->request->input('encryption'));
        $this->settings->set('mail.port', $this->request->input('port'));
        $this->settings->set('mail.host', $this->request->input('host'));
        $this->settings->set('mail.from', $this->request->input('from'));
        $this->settings->set('mail.username', $this->request->input('username'));
        $this->settings->set('mail.password', $this->request->input('password'));
        $this->withCode(200)->withMessage('修改设置成功！');
    }
}
