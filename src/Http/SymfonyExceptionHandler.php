<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Http;

use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler;

/**
 * Class SymfonyExceptionHandler.
 */
class SymfonyExceptionHandler extends ExceptionHandler
{
    /**
     * @var bool
     */
    protected $debug = true;

    public function __construct($debug = true, $charset = null, $fileLinkFormat = null)
    {
        parent::__construct($debug, $charset, $fileLinkFormat);
        $this->debug = $debug;
    }

    /**
     * @param FlattenException $exception
     *
     * @return string
     */
    public function getContent(FlattenException $exception)
    {
        switch ($exception->getStatusCode()) {
            case 404:
                $title = '对不起，页面已丢失！';
                break;
            default:
                $title = '错误：' . $exception->getMessage();
        }
        $content = '';
        if ($this->debug) {
            return parent::getContent($exception);
        }
        return <<<EOF
            <div class="exception-summary">
                <div class="container">
                    <div class="exception-message-wrapper">
                        <h1 class="break-long-words exception-message">$title</h1>
                    </div>
                </div>
            </div>

            <div class="container">
                $content
            </div>
EOF;
    }
}