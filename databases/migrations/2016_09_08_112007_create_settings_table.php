<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
use Illuminate\Database\Schema\Blueprint;
use Zs\Foundation\Database\Migrations\Migration;

/**
 * Class CreateSettingsTable.
 */
class CreateSettingsTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        $this->schema->create('settings', function (Blueprint $table) {
            $table->string('key', 100)->primary();
            $table->text('value')->nullable();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        $this->schema->drop('settings');
    }
}
