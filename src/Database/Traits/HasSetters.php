<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Database\Traits;

use Closure;

/**
 * Trait HasSetters.
 */
trait HasSetters
{
    /**
     * @var array
     */
    protected $setters = [];

    /**
     * Set a given attribute on the model.
     *
     * @param  string $key
     * @param  mixed  $value
     *
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        if (isset($this->setters[$key])) {
            if (is_string($attributes = $this->setters[$key])) {
                list($rule, $default) = explode('|', $attributes);
                $format = null;
            } else {
                $rule = $attributes[0];
                $default = $attributes[1];
                $format = isset($attributes[3]) ?: null;
            }
            if ($rule instanceof Closure && $rule($value)) {
                parent::setAttribute($key, $default instanceof Closure ? $default($value) : $default);
            } else if (is_string($rule)) {
                switch ($rule) {
                    case 'empty':
                        if (empty($value)) {
                            parent::setAttribute($key, $default instanceof Closure ? $default($value) : $default);
                        } else {
                            parent::setAttribute($key, $format instanceof Closure ? $format($value) : $value);
                        }
                        break;
                    case 'null':
                        if (is_null($value)) {
                            parent::setAttribute($key, $default instanceof Closure ? $default($value) : $default);
                        } else {
                            parent::setAttribute($key, $format instanceof Closure ? $format($value) : $value);
                        }
                        break;
                    default:
                        parent::setAttribute($key, $format instanceof Closure ? $format($value) : $value);
                        break;
                }
            } else {
                parent::setAttribute($key, $format instanceof Closure ? $format($value) : $value);
            }
        } else {
            parent::setAttribute($key, $value);
        }

        return $this;
    }
}
