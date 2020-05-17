<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTinyPumpDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiny_pump_devices', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();
            $table->unsignedBigInteger('device_id');

            $table->boolean('on_level');
            $table->boolean('on_mode');

            $table->float('l_cal')->nullable();
            $table->float('l_min')->nullable();
            $table->float('l_max')->nullable();
            $table->integer('tdly')->unsigned();
            $table->float('l_offset')->nullable();
            $table->string('l_is')->nullable();
            $table->string('channel1')->nullable();
            $table->string('channel2')->nullable();
            $table->string('channel3')->nullable();
            $table->dateTime('l_change_at')->nullable();
            $table->dateTime('l_out_at')->nullable();

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
        Schema::dropIfExists('tiny_pump_devices');
    }
}
