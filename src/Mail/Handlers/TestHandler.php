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
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;
use Zs\Foundation\Routing\Abstracts\Handler;
use Zs\Foundation\Setting\Contracts\SettingsRepository;

/**
 * Class TestHandler.
 */
class TestHandler extends Handler
{
    /**
     * @var \Illuminate\Contracts\Mail\Mailer
     */
    protected $mailer;

    /**
     * @var \Zs\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    /**
     * TestHandler constructor.
     *
     * @param \Illuminate\Container\Container                         $container
     * @param \Illuminate\Contracts\Mail\Mailer                       $mailer
     * @param \Zs\Foundation\Setting\Contracts\SettingsRepository $settings
     */
    public function __construct(Container $container, Mailer $mailer, SettingsRepository $settings)
    {
        parent::__construct($container);
        $this->mailer = $mailer;
        $this->settings = $settings;
    }

    /**
     * Execute Handler.
     */
    public function execute()
    {
        $this->container->make('log')->info('Mail testing', [$this->mailer]);
        $this->mailer->raw($this->request->input('content'), function (Message $message) {
            $message->to($this->request->input('to'));
            $message->subject('邮件功能测试');
        });
        $this->container->make('log')->info('Mail testing', [$this->mailer->failures()]);
        $this->withCode(200)->withMessage('测试邮件成功！');
    }
}
