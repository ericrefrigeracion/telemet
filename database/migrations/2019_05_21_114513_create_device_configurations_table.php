<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_configurations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('ch1_monitor')->nullable();
            $table->float('ch1_min')->nullable();
            $table->float('ch1_max')->nullable();
            $table->integer('ch1_delay')->unsigned()->nullable();
            $table->float('ch1_calibration')->nullable();
            $table->boolean('ch2_monitor')->nullable();
            $table->float('ch2_min')->nullable();
            $table->float('ch2_max')->nullable();
            $table->integer('ch2_delay')->unsigned()->nullable();
            $table->float('ch2_calibration')->nullable();
            $table->boolean('mail_send')->nullable();
            $table->unsignedBigInteger('device_id');
            $table->timestamps();

            $table->foreign('device_id')->references('id')->on('devices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_configurations');
    }
}
