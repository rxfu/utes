<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique()->comment('用户名');
            $table->string('password')->comment('密码');
            $table->string('name')->comment('真实姓名');
            $table->unsignedBigInteger('gender_id')->nullable()->comment('性别ID');
            $table->unsignedBigInteger('department_id')->nullable()->comment('学院ID');
            $table->string('uid')->unique()->nullable()->comment('工号');
            $table->string('phone')->unique()->nullable()->comment('联系电话');
            $table->string('email')->unique()->nullable()->comment('电子邮箱');
            $table->timestamp('email_verified_at')->nullable()->comment('电子邮箱验证时间');
            $table->boolean('is_enable')->default(true)->comment('是否启用，0-未启用，1-启用');
            $table->boolean('is_super')->default(false)->comment('是否超级管理员，0-否，1-是');
            $table->timestamp('last_login_at')->nullable()->comment('最后登录时间');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
