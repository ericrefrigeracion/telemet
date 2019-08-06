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
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->boolean('admin_mon')->nullable();
            $table->boolean('on_line')->nullable();
            $table->boolean('send_mails')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamp('view_alerts_at');
            $table->string('mdl');
            $table->boolean('tmon');
            $table->float('tmin');
            $table->float('tmax');
            $table->integer('tdly')->unsigned();
            $table->float('tcal');
            $table->timestamp('twatch')->nullable();
            $table->boolean('hmon');
            $table->float('hmin');
            $table->float('hmax');
            $table->integer('hdly')->unsigned();
            $table->float('hcal');
            $table->timestamp('hwatch')->nullable();
            $table->timestamp('monitor_expires_at')->nullable();
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
