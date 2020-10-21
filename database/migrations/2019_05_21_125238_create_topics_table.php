<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('icon_id')->nullable();
            $table->string('slug');
            $table->string('unit');
            $table->string('name');
            $table->integer('decimals');
            $table->string('color');
            $table->string('filled');
            $table->timestamps();

            $table->foreign('icon_id')->references('id')->on('icons')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
