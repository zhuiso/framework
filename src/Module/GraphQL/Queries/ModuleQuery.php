<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Module\GraphQL\Queries;

use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\Type;
use Zs\Foundation\GraphQL\Abstracts\Query;
use Zs\Foundation\Module\Module;

/**
 * Class ConfigurationQuery.
 */
class ModuleQuery extends Query
{
    /**
     * @return array
     */
    public function args()
    {
        return [
            'enabled'   => [
                'defaultValue' => null,
                'name'         => 'enabled',
                'type'         => Type::boolean(),
            ],
            'installed' => [
                'defaultValue' => null,
                'name'         => 'installed',
                'type'         => Type::boolean(),
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     *
     * @return array
     */
    public function resolve($root, $args)
    {
        if ($args['enabled'] === true) {
            $collection = $this->module->enabled();
        } else if ($args['installed'] === true) {
            $collection = $this->module->installed();
        } else if ($args['installed'] === false) {
            $collection = $this->module->notInstalled();
        } else {
            $collection = $this->module->repository();
        }

        return $collection->map(function (Module $module) {
            $authors = (array)$module->get('authors');
            foreach ($authors as $key => $author) {
                if (isset($author['name']) && isset($author['email'])) {
                    $authors[$key] = $author['name'] . ' <' . $author['email'] . '>';
                } else {
                    unset($authors[$key]);
                }
            }
            $module->offsetSet('authors', implode(',', $authors));

            return $module;
        })->filter(function (Module $module) {
            return $module->identification() !== 'zs/administration';
        })->toArray();
    }

    /**
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function type(): ListOfType
    {
        return Type::listOf($this->graphql->type('module'));
    }
}
