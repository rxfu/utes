<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreteachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoreteachers', function (Blueprint $table) {
            $table->id();
            $table->string('year', 4)->comment('年度');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('测评教师ID');
            $table->decimal('score', 5, 2)->default(0)->comment('成绩');
            $table->foreignId('judge_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('评委ID');
            $table->text('course')->comment('主讲本科课程名称');
            $table->text('time')->comment('上课时间');
            $table->text('classroom')->comment('上课地点');
            $table->text('class')->comment('班级');
            $table->string('file')->nullable()->comment('听课评价表');
            $table->boolean('is_confirmed')->default(false)->comment('成绩确认状态，0-未确认，1-已确认');
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
        Schema::dropIfExists('scoreteachers');
    }
}
