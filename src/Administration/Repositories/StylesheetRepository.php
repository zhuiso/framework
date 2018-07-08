<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Administration\Repositories;

use Illuminate\Support\Collection;
use Zs\Foundation\Http\Abstracts\Repository;

/**
 * Class StylesheetRepository.
 */
class StylesheetRepository extends Repository
{
    /**
     * Initialize.
     *
     * @param \Illuminate\Support\Collection $collection
     */
    public function initialize(Collection $collection)
    {
        $this->module->assets()->filter(function ($definition) {
            return isset($definition['entry'])
                && isset($definition['type'])
                && $definition['entry'] == 'administration'
                && $definition['type'] == 'stylesheet';
        })->each(function ($definition) {
            $definition['file'] = $this->url->asset($definition['file']);
            $this->items[] = $definition;
        });
        $this->addon->assets()->filter(function ($definition) {
            return isset($definition['entry'])
                && isset($definition['type'])
                && $definition['entry'] == 'administration'
                && $definition['type'] == 'stylesheet';
        })->each(function ($definition) {
            $definition['file'] = $this->url->asset($definition['file']);
            $this->items[] = $definition;
        });
    }
}
