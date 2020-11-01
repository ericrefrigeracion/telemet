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

            $table->unsignedBigInteger('type_device_id')->nullable();
            $table->unsignedBigInteger('protection_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('icon_id')->nullable();

            $table->string('name');
            $table->string('description')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();

            $table->boolean('admin_mon');
            $table->boolean('protected');
            $table->boolean('on_line');

            $table->dateTime('monitor_expires_at')->nullable();
            $table->dateTime('view_alerts_at')->nullable();
            $table->string('notification_email')->nullable();
            $table->string('notification_phone_number')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('type_device_id')->references('id')->on('type_devices')->onDelete('set null');
            $table->foreign('protection_id')->references('id')->on('protections')->onDelete('set null');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null');
            $table->foreign('icon_id')->references('id')->on('icons')->onDelete('set null');
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
