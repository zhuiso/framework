<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Database\Migrations;

use Illuminate\Database\ConnectionInterface;

/**
 * Class Migration.
 */
abstract class Migration
{
    /**
     * @var \Illuminate\Database\ConnectionInterface
     */
    protected $connection;

    /**
     * @var \Illuminate\Database\Schema\Builder
     */
    protected $schema;
    
    /**
     * @var bool
     */
    public $withinTransaction = true;

    /**
     * Migration constructor.
     *
     * @param \Illuminate\Database\ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
        $this->schema = call_user_func([
            $connection,
            'getSchemaBuilder',
        ]);
    }

    /**
     * Migration's down handler.
     *
     * @return mixed
     */
    abstract public function down();

    /**
     * Get connection instance.
     *
     * @return string
     */
    public function getConnection()
    {
        return '';
    }

    /**
     * Migration's up handler.
     *
     * @return mixed
     */
    abstract public function up();
}
