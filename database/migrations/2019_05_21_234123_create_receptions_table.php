<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('data01')->nullable();
            $table->float('data02')->nullable();
            $table->float('data03')->nullable();
            $table->float('data04')->nullable();
            $table->float('data05')->nullable();
            $table->float('data06')->nullable();
            $table->float('data07')->nullable();
            $table->float('data08')->nullable();
            $table->float('data09')->nullable();
            $table->float('data10')->nullable();
            $table->float('data11')->nullable();
            $table->integer('rssi')->nullable();
            $table->string('log')->nullable();
            $table->unsignedBigInteger('device_id');
            $table->timestamps();

            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receptions');
    }
}
