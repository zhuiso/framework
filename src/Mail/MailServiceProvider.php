<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Mail;

use Illuminate\Mail\MailServiceProvider as IlluminateMailServiceProvider;
use Illuminate\Mail\Markdown;

/**
 * Class MailServiceProvider.
 */
class MailServiceProvider extends IlluminateMailServiceProvider
{
    /**
     * Register the Markdown renderer instance.
     */
    protected function registerMarkdownRenderer()
    {
        $this->app->singleton(Markdown::class, function ($app) {
            $config = $app['config'];

            return new Markdown($app['view'], [
                'theme' => $config->get('mail.markdown.theme', 'default'),
                'paths' => $config->get('mail.markdown.paths', []),
            ]);
        });
    }
}
