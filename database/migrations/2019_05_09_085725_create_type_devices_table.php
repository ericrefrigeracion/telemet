<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('icon_id')->nullable();
            $table->integer('prefix');
            $table->string('model');
            $table->string('description');

            $table->timestamps();
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
        Schema::dropIfExists('type_devices');
    }
}
