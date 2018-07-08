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
 * Class CreateSeoRulesTable.
 */
class CreateSeoRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('seo_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('module')->comment('模块');
            $table->string('path')->comment('路径');
            $table->text('template')->nullable()->comment('模板');
            $table->tinyInteger('order')->nullable()->default(0)->comment('排序');
            $table->tinyInteger('open')->nullable()->default(0)->comment('是否开启');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->drop('seo_rules');
    }
}
