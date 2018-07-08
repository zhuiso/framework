<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\GraphQL\Abstracts;

use GraphQL\Type\Definition\Type as TypeDefinition;
use Illuminate\Container\Container;
use Zs\Foundation\GraphQL\Errors\AuthorizationError;
use Zs\Foundation\GraphQL\GraphQLManager;
use Zs\Foundation\GraphQL\Traits\ShouldValidate;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class Mutation.
 */
abstract class Mutation
{
    use Helpers {
        __get as HelperGet;
    }
    use ShouldValidate;

    /**
     * @var array.
     */
    protected $attributes = [];

    /**
     * @var \Illuminate\Container\Container.
     */
    protected $container;

    /**
     * @var \Zs\Foundation\GraphQL\GraphQLManager.
     */
    protected $graphql;

    /**
     * Query constructor.
     *
     * @param \Illuminate\Container\Container           $container
     * @param \Zs\Foundation\GraphQL\GraphQLManager $graphql
     */
    public function __construct(Container $container, GraphQLManager $graphql)
    {
        $this->container = $container;
        $this->graphql = $graphql;
    }

    /**
     * @param $root
     * @param $args
     *
     * @return bool
     */
    public function authorize($root, $args)
    {
        return true;
    }

    /**
     * @return array
     */
    abstract public function args(): array;

    /**
     * @return array
     */
    public function attributes()
    {
        return [];
    }

    /**
     * Get the attributes from the container.
     *
     * @return array
     */
    public function getAttributes()
    {
        $attributes = $this->attributes();
        $args = $this->args();
        $attributes = array_merge($this->attributes, [
            'args' => $args,
        ], $attributes);
        $type = $this->type();
        if (isset($type)) {
            $attributes['type'] = $type;
        }
        $resolver = $this->getResolver();
        if (isset($resolver)) {
            $attributes['resolve'] = $resolver;
        }

        return $attributes;
    }

    /**
     * @param $root
     * @param $args
     *
     * @return mixed
     */
    abstract public function resolve($root, $args);

    /**
     * @return \Closure|null
     */
    protected function getResolver()
    {
        $resolver = [$this, 'resolve'];
        $authorize = [$this, 'authorize'];
        return function () use ($resolver, $authorize) {
            $args = func_get_args();
            if (call_user_func_array($authorize, $args) !== true) {
                throw new AuthorizationError('Unauthorized');
            }
            return call_user_func_array($resolver, $args);
        };
    }

    /**
     * Convert the Fluent instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->getAttributes();
    }

    /**
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function type()
    {
        return TypeDefinition::listOf(TypeDefinition::string());
    }

    /**
     * Dynamically retrieve the value of an attribute.
     *
     * @param  string $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        $attributes = $this->toArray();

        return isset($attributes[$key]) ? $attributes[$key] : $this->HelperGet($key);
    }
}
