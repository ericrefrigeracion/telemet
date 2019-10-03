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
            $table->unsignedBigInteger('type_device_id');
            $table->unsignedBigInteger('protection_id');

            $table->string('name');
            $table->string('description')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();

            $table->boolean('admin_mon');
            $table->boolean('protected');
            $table->boolean('on_line');

            $table->dateTime('monitor_expires_at');
            $table->dateTime('view_alerts_at');
            $table->string('notification_email')->nullable();
            $table->string('notification_phone_number')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('type_device_id')->references('id')->on('type_devices')->onDelete('cascade');
            $table->foreign('protection_id')->references('id')->on('protections')->onDelete('cascade');
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
