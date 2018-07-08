<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Administration;

use InvalidArgumentException;
use Zs\Foundation\Administration\Abstracts\Administrator;
use Zs\Foundation\Administration\Repositories\NavigationRepository;
use Zs\Foundation\Administration\Repositories\PageRepository;
use Zs\Foundation\Administration\Repositories\ScriptRepository;
use Zs\Foundation\Administration\Repositories\StylesheetRepository;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class AdministrationManager.
 */
class AdministrationManager
{
    use Helpers;

    /**
     * @var \Zs\Foundation\Administration\Abstracts\Administrator
     */
    protected $administrator;

    /**
     * @var \Zs\Foundation\Administration\Repositories\NavigationRepository
     */
    protected $navigationRepository;

    /**
     * @var \Zs\Foundation\Administration\Repositories\PageRepository
     */
    protected $pageRepository;

    /**
     * @var \Zs\Foundation\Administration\Repositories\ScriptRepository
     */
    protected $scriptRepository;

    /**
     * @var \Zs\Foundation\Administration\Repositories\StylesheetRepository
     */
    protected $stylesheetRepository;

    /**
     * Get administrator.
     *
     * @return \Zs\Foundation\Administration\Abstracts\Administrator
     */
    public function getAdministrator()
    {
        return $this->administrator;
    }

    /**
     * Status of administrator's instance.
     *
     * @return bool
     */
    public function hasAdministrator()
    {
        return is_null($this->administrator) ? false : true;
    }

    /**
     * Set administrator instance.
     *
     * @param \Zs\Foundation\Administration\Abstracts\Administrator $administrator
     *
     * @throws \InvalidArgumentException
     */
    public function setAdministrator(Administrator $administrator)
    {
        if (is_object($this->administrator)) {
            throw new InvalidArgumentException('Administrator has been Registered!');
        }
        if ($administrator instanceof Administrator) {
            $this->administrator = $administrator;
            $this->administrator->init();
        } else {
            throw new InvalidArgumentException('Administrator must be instanceof ' . Administrator::class . '!');
        }
    }

    /**
     * @return \Zs\Foundation\Administration\Repositories\NavigationRepository
     */
    public function navigations()
    {
        if (!$this->navigationRepository instanceof NavigationRepository) {
            $this->navigationRepository = new NavigationRepository();
            $this->navigationRepository->initialize($this->module->menus()->structures());
        }

        return $this->navigationRepository;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function pages()
    {
        if (!$this->pageRepository instanceof PageRepository) {
            $this->pageRepository = new PageRepository();
            $this->pageRepository->initialize(collect());
        }

        return $this->pageRepository;
    }

    /**
     * @return \Zs\Foundation\Administration\Repositories\ScriptRepository
     */
    public function scripts()
    {
        if (!$this->scriptRepository instanceof ScriptRepository) {
            $this->scriptRepository = new ScriptRepository();
            $this->scriptRepository->initialize(collect());
        }

        return $this->scriptRepository;
    }

    /**
     * @return \Zs\Foundation\Administration\Repositories\StylesheetRepository
     */
    public function stylesheets()
    {
        if (!$this->stylesheetRepository instanceof  StylesheetRepository) {
            $this->stylesheetRepository = new StylesheetRepository();
            $this->stylesheetRepository->initialize(collect());
        }

        return $this->stylesheetRepository;
    }
}
