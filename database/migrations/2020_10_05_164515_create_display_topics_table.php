<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisplayTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('display_topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('display_id');
            $table->unsignedBigInteger('topic_id');
            $table->timestamps();

            $table->foreign('display_id')->references('id')->on('displays')->onDelete('cascade');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('display_topics');
    }
}
