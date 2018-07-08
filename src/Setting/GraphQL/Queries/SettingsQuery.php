<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Setting\GraphQL\Queries;

use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\Type;
use Zs\Foundation\GraphQL\Abstracts\Query;

/**
 * Class SettingQuery.
 */
class SettingsQuery extends Query
{
    /**
     * @return array
     */
    public function args()
    {
        return [
            'key' => [
                'name' => 'key',
                'type' => Type::string(),
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     *
     * @return array|\stdClass
     */
    public function resolve($root, $args)
    {
        if (isset($args['key'])) {
            return [
                [
                    'key'   => $args['key'],
                    'value' => $this->setting->get($args['key']),
                ],
            ];
        }
        $settings = $this->setting->all()->map(function ($value, $key) {
            return ['key' => $key, 'value' => $value];
        })->values();

        return $settings->toArray();
    }

    /**
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function type(): ListOfType
    {
        return Type::listOf($this->graphql->type('settings'));
    }
}
