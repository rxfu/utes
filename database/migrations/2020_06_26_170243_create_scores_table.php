<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('year', 4)->comment('年度');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('测评教师ID');
            $table->decimal('student1', 5, 2)->default(0)->comment('学生评价成绩1');
            $table->decimal('plan1', 5, 2)->default(0)->comment('教案评价成绩1');
            $table->decimal('plan2', 5, 2)->default(0)->comment('教案评价成绩2');
            $table->decimal('peer1', 5, 2)->default(0)->comment('同行评价成绩1');
            $table->decimal('peer2', 5, 2)->default(0)->comment('同行评价成绩2');
            $table->decimal('peer3', 5, 2)->default(0)->comment('同行评价成绩3');
            $table->decimal('expert1', 5, 2)->default(0)->comment('专家评价成绩1');
            $table->decimal('expert2', 5, 2)->default(0)->comment('专家评价成绩2');
            $table->decimal('expert3', 5, 2)->default(0)->comment('专家评价成绩3');
            $table->decimal('expert4', 5, 2)->default(0)->comment('专家评价成绩4');
            $table->decimal('expert5', 5, 2)->default(0)->comment('专家评价成绩5');
            $table->unsignedBigInteger('creator_id')->comment('创建者ID');
            $table->timestamps();

            $table->foreign('creator_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
