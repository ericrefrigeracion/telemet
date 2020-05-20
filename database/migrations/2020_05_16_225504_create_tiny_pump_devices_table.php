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
            $table->string('status_channel1');
            $table->string('status_channel2');
            $table->string('status_channel3');

            $table->string('signal_mode');
            $table->string('control_mode');
            $table->float('l_cal');
            $table->float('l_min');
            $table->float('l_max');
            $table->float('l_offset');
            $table->integer('l_dly');

            $table->float('channel1_min');
            $table->float('channel1_max');
            $table->float('channel2_min');
            $table->float('channel2_max');
            $table->float('channel3_min');
            $table->float('channel3_max');

            $table->dateTime('l_change_at')->nullable();
            $table->dateTime('l_out_at')->nullable();
            $table->dateTime('device_update')->nullable();

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
