<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('year', 4)->comment('年度');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('用户ID');
            $table->unsignedBigInteger('degree_id')->nullable()->comment('学位ID');
            $table->unsignedBigInteger('title_id')->nullable()->comment('现有职称ID');
            $table->unsignedBigInteger('applied_title_id')->nullable()->comment('申报职称ID');
            $table->boolean('is_applied_expert')->default(true)->comment('是否申请专家评价，0-否，1-是');
            $table->unsignedInteger('reason')->default(0)->comment('0-无理由，1-五年内参加全国高校青年教师教学竞赛、广西高校青年教师教学竞赛，2-五年内曾获评校级及以上教学新秀、教学能手等各类教学荣誉称号者');
            $table->text('file')->nullable()->comment('相关证明材料，图片格式，分号分隔文件名');
            $table->unsignedInteger('is_audit')->default(0)->comment('0-未审核，1-审核已通过，2-审核未通过');
            $table->text('audit_reason')->nullable()->comment('审核理由');
            $table->boolean('has_course')->default(true)->comment('本学期是否有课，0-无课，1-有课');
            $table->string('course', 128)->nullable()->comment('主讲本科课程名称');
            $table->unsignedBigInteger('subject_id')->nullable()->comment('所属学科ID');
            $table->text('remark')->nullable()->comment('备注');
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
        Schema::dropIfExists('applications');
    }
}
