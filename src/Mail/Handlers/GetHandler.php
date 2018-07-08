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
 * Class GetHandler.
 */
class GetHandler extends Handler
{
    /**
     * @var \Zs\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    /**
     * GetHandler constructor.
     *
     * @param Container $container
     * @param SettingsRepository $settings
     */
    public function __construct(Container $container, SettingsRepository $settings)
    {
        parent::__construct($container);
        $this->settings = $settings;
    }

    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    protected function execute()
    {
        $this->withCode(200)->withData([
            'driver' => $this->settings->get('mail.driver', 'mail'),
            'encryption' => $this->settings->get('mail.encryption', 'none'),
            'port' => $this->settings->get('mail.port', '25'),
            'host' => $this->settings->get('mail.host', ''),
            'from' => $this->settings->get('mail.from', ''),
            'username' => $this->settings->get('mail.username', ''),
            'password' => $this->settings->get('mail.password', ''),
        ])->withMessage('获取邮件配置成功！');
    }
}
