<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 50)->unique()->comment('菜单唯一标识符');
            $table->string('name')->comment('名称');
            $table->text('description')->nullable()->comment('描述');
            $table->boolean('is_enable')->default(true)->comment('是否启用，0-未启用，1-启用');
            $table->boolean('forbidden_delete')->default(0)->comment('是否禁止删除，0-允许删除，1-禁止删除');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
