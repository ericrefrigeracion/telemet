<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTinyTDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiny_t_devices', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();
            $table->unsignedBigInteger('device_id');

            $table->boolean('on_temp');
            $table->boolean('on_t_set_point');

            $table->integer('tdly')->unsigned();
            $table->float('tcal');
            $table->float('t_set_point');
            $table->float('tmin');
            $table->float('tmax');
            $table->string('t_is');
            $table->dateTime('t_change_at');
            $table->dateTime('t_out_at')->nullable();

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
        Schema::dropIfExists('tiny_t_devices');
    }
}
