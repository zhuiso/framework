<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Routing\Abstracts;

use Closure;
use Exception;
use Illuminate\Container\Container;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Zs\Foundation\Routing\Responses\ApiResponse;
use Zs\Foundation\Permission\PermissionManager;
use Zs\Foundation\Validation\ValidatesRequests;

/**
 * Class Handler.
 */
abstract class Handler
{
    use ValidatesRequests;

    /**
     * @var int
     */
    protected $code = 200;

    /**
     * @var \Illuminate\Container\Container|\Zs\Foundation\Application
     */
    protected $container;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $data;

    /**
     * @var array
     */
    protected $errors;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $extra;

    /**
     * @var \Zs\Foundation\Flow\FlowManager
     */
    protected $flow;

    /**
     * @var \Illuminate\Contracts\Logging\Log
     */
    protected $log;

    /**
     * @var array
     */
    protected $messages;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \Symfony\Component\Translation\TranslatorInterface
     */
    protected $translator;

    /**
     * Handler constructor.
     *
     * @param \Illuminate\Container\Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->data = new Collection();
        $this->errors = new Collection();
        $this->extra = new Collection();
        $this->flow = $this->container->make('flow');
        $this->log = $this->container->make('log');
        $this->messages = new Collection();
        $this->request = $this->container->make('request');
        $this->translator = $this->container->make('translator');
    }

    /**
     * Begin transaction for database.
     */
    protected function beginTransaction()
    {
        $this->container->make('db')->beginTransaction();
    }

    /**
     * commit transaction for database.
     */
    protected function commitTransaction()
    {
        $this->container->make('db')->commit();
    }

    /**
     * Execute Handler.
     *
     * @throws \Exception
     */
    abstract protected function execute();

    /**
     * @param \Zs\Foundation\Routing\Responses\ApiResponse $response
     * @param \Exception                                       $exception
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse
     */
    protected function handleExceptions(ApiResponse $response, Exception $exception)
    {
        if ($exception instanceof ValidationException) {
            return $response->withParams([
                'code'    => 422,
                'message' => $exception->validator->errors()->getMessages(),
                'trace'   => $exception->getTrace(),
            ]);
        }

        return $response->withParams([
            'code'    => $exception->getCode(),
            'message' => $exception->getMessage(),
            'trace'   => $exception->getTrace(),
        ]);
    }

    /**
     * @param $permission
     *
     * @return bool
     */
    protected function permission($permission)
    {
        return $this->container->make(PermissionManager::class)->check($permission);
    }

    /**
     * Rollback transaction for database.
     */
    protected function rollBackTransaction()
    {
        $this->container->make('db')->rollBack();
    }

    /**
     * @param \Closure $closure
     * @param int      $attempts
     */
    protected function transaction(Closure $closure, $attempts = 1)
    {
        $this->container->make('db')->transaction($closure, $attempts);
    }

    /**
     * Make data to response with errors or messages.
     *
     * @return \Zs\Foundation\Routing\Responses\ApiResponse
     * @throws \Exception
     */
    public function toResponse()
    {
        $response = new ApiResponse();
        try {
            $this->execute();
            if ($this->code !== 200) {
                $messages = $this->errors->toArray();
            } else {
                $messages = $this->messages->toArray();
            }
            $response = $response->withParams([
                'code'    => $this->code,
                'data'    => $this->data->toArray(),
                'message' => $messages,
            ]);
            if ($this->extra->count()) {
                $response = $response->withParams($this->extra->toArray());
            }

            return $response;
        } catch (Exception $exception) {
            return $this->handleExceptions($response, $exception);
        }
    }

    /**
     * @param int $code
     *
     * @return $this
     */
    protected function withCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @param      $data
     * @param bool $override
     *
     * @return $this
     */
    protected function withData($data, $override = false)
    {
        if ($data instanceof Arrayable) {
            $data = $data->toArray();
        }
        foreach ((array)$data as $key=>$value) {
            if (is_numeric($key)) {
                if ($this->data->has($key) && $override) {
                    $this->data->push($value);
                } else {
                    $this->data->put($key, $value);
                }
            } else {
                $this->data->put($key, $value);
            }
        }

        return $this;
    }

    /**
     * @param array|string $errors
     *
     * @return $this
     */
    protected function withError($errors)
    {
        foreach ((array)$errors as $error) {
            $this->errors->push($this->translator->trans($error));
        }

        return $this;
    }

    /**
     * @param $extras
     *
     * @return $this
     */
    public function withExtra($extras)
    {
        foreach ((array)$extras as $key=>$extra) {
            if (!is_numeric($key)) {
                $this->extra->put($key, $extra);
            }
        }

        return $this;
    }

    /**
     * @param array|string $messages
     *
     * @return $this
     */
    protected function withMessage($messages)
    {
        foreach ((array)$messages as $message) {
            $this->messages->push($this->translator->trans($message));
        }

        return $this;
    }
}
