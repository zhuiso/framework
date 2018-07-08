<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\GraphQL\Traits;

use Zs\Foundation\GraphQL\Errors\ValidationError;

/**
 * Class ShouldValidate.
 */
trait ShouldValidate
{
    /**
     * @return array
     */
    protected function rules(): array
    {
        return [];
    }

    /**
     * Get The validate rules.
     *
     * @param mixed $arguments
     * @return array
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function getRules(...$arguments): array
    {
        $rules = [];
        // Make rules.
        foreach ($this->args() as $name => $arg) {
            if (! isset($arg['rules'])) {
                continue;
            }

            // setting rules.
            $rules[$name] = $arg['rules'];
            if (is_callable($arg['rules'])) {
                $rules[$name] = call_user_func($arg['rules'], ...$arguments);
            }
        }

        return array_merge($this->rules(...$arguments), $rules);
    }

    /**
     * @param $args
     * @param $rules
     *
     * @return mixed
     */
    protected function getValidator($args, $rules)
    {
        return app('validator')->make($args, $rules);
    }

    /**
     * @return \Closure|null
     */
    protected function getResolver()
    {
        $resolver = $this->getResolver();
        if (!$resolver) {
            return null;
        }

        return function () use ($resolver) {
            $arguments = func_get_args();
            $rules = call_user_func_array([$this, 'getRules'], $arguments);
            if (sizeof($rules)) {
                $args = array_get($arguments, 1, []);
                $validator = $this->getValidator($args, $rules);
                if ($validator->fails()) {
                    throw with(new ValidationError('validation'))->setValidator($validator);
                }
            }

            return call_user_func_array($resolver, $arguments);
        };
    }
}
