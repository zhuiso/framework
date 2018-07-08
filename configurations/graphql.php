<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
return [
    'schema'  => 'default',
    'schemas' => [
        'default' => [
            'mutation' => [
                'enableAddon'        => \Zs\Foundation\Addon\GraphQL\Mutations\EnableMutation::class,
                'enableModule'       => \Zs\Foundation\Module\GraphQL\Mutations\EnableMutation::class,
                'exportAddon'        => \Zs\Foundation\Addon\GraphQL\Mutations\ExportMutation::class,
                'exportModule'       => \Zs\Foundation\Module\GraphQL\Mutations\ExportMutation::class,
                'navigations'        => \Zs\Foundation\Administration\GraphQL\Mutations\NavigationMutation::class,
                'clearCache'         => \Zs\Foundation\Cache\GraphQL\Mutations\ClearMutation::class,
                'importAddon'        => \Zs\Foundation\Addon\GraphQL\Mutations\ImportMutation::class,
                'importModule'       => \Zs\Foundation\Module\GraphQL\Mutations\ImportMutation::class,
                'installAddon'       => \Zs\Foundation\Addon\GraphQL\Mutations\InstallMutation::class,
                'installExtension'   => \Zs\Foundation\Extension\GraphQL\Mutations\InstallMutation::class,
                'installModule'      => \Zs\Foundation\Module\GraphQL\Mutations\InstallMutation::class,
                'setting'            => \Zs\Foundation\Setting\GraphQL\Mutations\SettingMutation::class,
                'settings'           => \Zs\Foundation\Setting\GraphQL\Mutations\SettingsMutation::class,
                'uninstallAddon'     => \Zs\Foundation\Addon\GraphQL\Mutations\UninstallMutation::class,
                'uninstallExtension' => \Zs\Foundation\Extension\GraphQL\Mutations\UninstallMutation::class,
                'uninstallModule'    => \Zs\Foundation\Module\GraphQL\Mutations\UninstallMutation::class,
            ],
            'query'    => [
                'addons'        => \Zs\Foundation\Addon\GraphQL\Queries\AddonQuery::class,
                'dashboards'    => \Zs\Foundation\Administration\GraphQL\Queries\DashboardQuery::class,
                'informations'  => \Zs\Foundation\Administration\GraphQL\Queries\InformationQuery::class,
                'navigations'   => \Zs\Foundation\Administration\GraphQL\Queries\NavigationQuery::class,
                'extensions'    => \Zs\Foundation\Extension\GraphQL\Queries\ExtensionQuery::class,
                'moduleDomains' => \Zs\Foundation\Module\GraphQL\Queries\DomainQuery::class,
                'modules'       => \Zs\Foundation\Module\GraphQL\Queries\ModuleQuery::class,
                'setting'       => \Zs\Foundation\Setting\GraphQL\Queries\SettingQuery::class,
                'settings'      => \Zs\Foundation\Setting\GraphQL\Queries\SettingsQuery::class,
            ],
        ],
    ],
    'types'   => [
        \Zs\Foundation\Addon\GraphQL\Types\AddonType::class,
        \Zs\Foundation\Administration\GraphQL\Types\DashboardType::class,
        \Zs\Foundation\Administration\GraphQL\Types\InformationType::class,
        \Zs\Foundation\Administration\GraphQL\Types\NavigationType::class,
        \Zs\Foundation\Extension\GraphQL\Types\ExtensionType::class,
        \Zs\Foundation\Module\GraphQL\Types\DomainType::class,
        \Zs\Foundation\Module\GraphQL\Types\ModuleType::class,
        \Zs\Foundation\Setting\GraphQL\Types\SettingsType::class,
    ],
];