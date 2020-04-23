<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menuitems', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 50)->unique()->comment('唯一标识符');
            $table->string('name')->comment('名称');
            $table->string('route')->nullable()->comment('路由名称');
            $table->string('icon')->nullable()->comment('图标');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('父菜单项ID');
            $table->foreignId('menu_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('菜单ID');
            $table->text('description')->nullable()->comment('描述');
            $table->boolean('is_enable')->default(true)->comment('是否启用，0-未启用，1-启用');
            $table->boolean('is_system')->default(false)->comment('是否系统菜单，0-否，1-是');
            $table->integer('order')->default(0)->comment('排序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menuitems');
    }
}
