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
            $table->string('uid', 50)->unique();
            $table->string('name');
            $table->string('route');
            $table->string('icon')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreignId('menu_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->text('description')->nullable();
            $table->boolean('is_enable')->default(true);
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
