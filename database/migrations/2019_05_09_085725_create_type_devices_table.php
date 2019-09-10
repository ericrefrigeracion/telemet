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
            $table->integer('prefix');
            $table->string('model');
            $table->string('description');
            $table->string('data01_unit')->nullable();
            $table->string('data02_unit')->nullable();
            $table->string('data03_unit')->nullable();
            $table->string('data04_unit')->nullable();
            $table->string('data05_unit')->nullable();
            $table->string('data06_unit')->nullable();
            $table->string('data07_unit')->nullable();
            $table->string('data08_unit')->nullable();
            $table->string('data09_unit')->nullable();
            $table->string('data10_unit')->nullable();
            $table->string('data11_unit')->nullable();
            $table->string('data12_unit')->nullable();
            $table->timestamps();
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
