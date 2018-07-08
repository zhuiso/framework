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
 * Class CreateTableMenuItems.
 */
class CreateTableMenuItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->integer('group_id');
            $table->string('title');
            $table->string('tooltip')->nullable();
            $table->string('link');
            $table->enum('target', ['_blank', '_self', '_parent', '_top'])->default('_blank');
            $table->string('color')->nullable();
            $table->string('icon_image')->nullable();
            $table->tinyInteger('order_id')->default(0);
            $table->boolean('enabled')->default(true);
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
        $this->schema->drop('menu_items');
    }
}
