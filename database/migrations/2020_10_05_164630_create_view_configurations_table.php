<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view_configurations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_device_id');
            $table->unsignedBigInteger('display_id');
            $table->unsignedBigInteger('topic_id');
            $table->integer('order');

            $table->timestamps();

            $table->foreign('type_device_id')->references('id')->on('type_devices')->onDelete('cascade');
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
        Schema::dropIfExists('view_configurations');
    }
}
