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
            $table->foreignId('gender_id')
                ->constrained()
                ->comment('性别ID');
            $table->foreignId('department_id')
                ->constrained()
                ->comment('学院ID');
            $table->foreignId('title_id')
                ->constrained()
                ->comment('现有职称ID');
            $table->foreignId('applied_title_id')
                ->constrained('titles')
                ->comment('申报职称ID');
            $table->boolean('is_applied_peer')->default(true)->comment('本学期是否申请同行评价');
            $table->text('course')->nullable()->comment('主讲本科课程名称');
            $table->text('time')->nullable()->comment('上课时间');
            $table->text('classroom')->nullable()->comment('上课地点');
            $table->text('class')->uullable()->comment('班级');
            $table->string('file')->nullable()->comment('教案');
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
