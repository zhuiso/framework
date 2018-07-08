<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Member;

use InvalidArgumentException;
use Zs\Foundation\Member\Abstracts\Manager;
use Zs\Foundation\Routing\Traits\Helpers;

/**
 * Class MemberManagement.
 */
class MemberManagement
{
    use Helpers;

    /**
     * @var array
     */
    protected $drivers = [];

    /**
     * @var string
     */
    protected $default;

    /**
     * @var \Zs\Foundation\Member\Abstracts\Manager
     */
    protected $manager;

    /**
     * Create a member.
     *
     * @param array $data
     * @param bool  $force
     *
     * @return \Zs\Foundation\Member\Member
     */
    public function create(array $data, $force = false)
    {
        return $this->manager->create($data, $force);
    }

    /**
     * Delete a member.
     *
     * @param array $data
     * @param bool  $force
     *
     * @return \Zs\Foundation\Member\Member
     */
    public function delete(array $data, $force = false)
    {
        return $this->manager->delete($data, $force);
    }

    /**
     * Edit a member info.
     *
     * @param array $data
     * @param bool  $force
     *
     * @return \Zs\Foundation\Member\Member
     */
    public function edit(array $data, $force = false)
    {
        return $this->manager->edit($data, $force);
    }

    /**
     * Find a member.
     *
     * @param $key
     *
     * @return \Zs\Foundation\Member\Member
     */
    public function find($key)
    {
        return $this->manager->find($key);
    }

    /**
     * Get manager instance.
     *
     * @return \Zs\Foundation\Member\Abstracts\Manager
     */
    public function manager()
    {
        return $this->manager;
    }

    /**
     * Register member manager instance.
     *
     * @param \Zs\Foundation\Member\Abstracts\Manager $manager
     */
    public function registerManager(Manager $manager)
    {
        if (is_object($this->manager)) {
            throw new InvalidArgumentException('Member Manager has been Registered!');
        }
        if ($manager instanceof Manager) {
            $this->manager = $manager;
            $this->manager->init();
        } else {
            throw new InvalidArgumentException('Member Manager must be instanceof ' . Manager::class . '!');
        }
    }

    /**
     * Store a member info.
     *
     * @param array $data
     * @param bool  $force
     *
     * @return \Zs\Foundation\Member\Member
     */
    public function store(array $data, $force = false)
    {
        return $this->manager->store($data, $force);
    }

    /**
     * Update a member info.
     *
     * @param array $data
     * @param bool  $force
     *
     * @return \Zs\Foundation\Member\Member
     */
    public function update(array $data, $force = false)
    {
        return $this->manager->update($data, $force);
    }
}
