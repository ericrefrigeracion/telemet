<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('mdl');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('allowed_schedule_type');
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->boolean('admin_mon');
            $table->boolean('allowed_schedule');
            $table->boolean('on_line');
            $table->boolean('on_temp');
            $table->boolean('on_hum');
            $table->boolean('on_t_set_point');
            $table->boolean('on_h_set_point');
            $table->boolean('send_mails');
            $table->dateTime('monitor_expires_at');
            $table->dateTime('view_alerts_at');
            $table->boolean('tmon');
            $table->integer('tdly')->unsigned();
            $table->float('tcal');
            $table->float('t_set_point');
            $table->string('t_is');
            $table->dateTime('t_change_at');
            $table->float('tmin');
            $table->dateTime('t_out_at')->nullable();
            $table->float('tmax');
            $table->boolean('hmon');
            $table->integer('hdly')->unsigned();
            $table->float('hcal');
            $table->float('h_set_point');
            $table->string('h_is');
            $table->dateTime('h_change_at');
            $table->float('hmin');
            $table->dateTime('h_out_at')->nullable();
            $table->float('hmax');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
