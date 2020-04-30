<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('用户ID');
            $table->unsignedInteger('ip')->default(0)->comment('IP地址');
            $table->unsignedInteger('code')->comment('代码');
            $table->string('path', 128)->comment('路径');
            $table->string('method', 10)->comment('方法');
            $table->string('action', 50)->comment('动作');
            $table->string('model', 50)->comment('模型');
            $table->string('model_id', 50)->comment('模型ID');
            $table->text('content')->comment('内容');
            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
