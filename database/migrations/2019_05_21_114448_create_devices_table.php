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
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->boolean('mon')->nullable();
            $table->float('min')->nullable();
            $table->float('max')->nullable();
            $table->integer('dly')->unsigned()->nullable();
            $table->float('cal')->nullable();
            $table->boolean('admin_mon')->nullable();
            $table->timestamp('watch')->nullable();
            $table->boolean('mail_send')->nullable();
            $table->unsignedBigInteger('user_id');
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
