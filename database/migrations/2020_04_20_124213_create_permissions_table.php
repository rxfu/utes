<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 20)->unique()->comment('唯一标识');
            $table->string('name', 20)->unique()->comment('名称');
            $table->string('module', 50)->comment('模型');
            $table->string('action', 50)->comment('动作');
            $table->boolean('by_group')->default(false)->comment('是否按分组分配权限，0-否，1-是');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('父权限ID');
            $table->text('description')->nullable()->comment('描述');
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
        Schema::dropIfExists('permissions');
    }
}
