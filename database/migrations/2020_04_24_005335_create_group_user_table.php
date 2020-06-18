<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_user', function (Blueprint $table) {
            $table->foreignId('group_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('组ID');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('用户ID');
            $table->unsignedInteger('seq')->nullable()->comment('序号');
            $table->boolean('is_drawed')->default(false)->comment('是否已抽签，0-否，1-是');
            $table->timestamps();

            $table->index(['user_id', 'group_id']);
            $table->unique(['user_id', 'group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_user');
    }
}
