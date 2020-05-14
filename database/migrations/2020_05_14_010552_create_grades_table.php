<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 20)->unique()->comment('唯一标识');
            $table->string('name', 50)->unique()->comment('名称');
            $table->decimal('maximum', 5, 2)->default(0)->comment('最大分值');
            $table->decimal('miniimum', 5, 2)->default(0)->comment('最小分值');
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
        Schema::dropIfExists('grades');
    }
}
