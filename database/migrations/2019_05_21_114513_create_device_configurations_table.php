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
            $table->boolean('data01_mon')->nullable();
            $table->float('data01_min')->nullable();
            $table->float('data01_max')->nullable();
            $table->integer('data01_dly')->unsigned()->nullable();
            $table->float('data01_cal')->nullable();
            $table->string('data01_typ')->nullable();
            $table->boolean('data02_mon')->nullable();
            $table->float('data02_min')->nullable();
            $table->float('data02_max')->nullable();
            $table->integer('data02_dly')->unsigned()->nullable();
            $table->float('data02_cal')->nullable();
            $table->string('data02_typ')->nullable();
            $table->boolean('data03_mon')->nullable();
            $table->float('data03_min')->nullable();
            $table->float('data03_max')->nullable();
            $table->integer('data03_dly')->unsigned()->nullable();
            $table->float('data03_cal')->nullable();
            $table->string('data03_typ')->nullable();
            $table->boolean('data04_mon')->nullable();
            $table->float('data04_min')->nullable();
            $table->float('data04_max')->nullable();
            $table->integer('data04_dly')->unsigned()->nullable();
            $table->float('data04_cal')->nullable();
            $table->string('data04_typ')->nullable();
            $table->boolean('data05_mon')->nullable();
            $table->float('data05_min')->nullable();
            $table->float('data05_max')->nullable();
            $table->integer('data05_dly')->unsigned()->nullable();
            $table->float('data05_cal')->nullable();
            $table->string('data05_typ')->nullable();
            $table->boolean('data06_mon')->nullable();
            $table->float('data06_min')->nullable();
            $table->float('data06_max')->nullable();
            $table->integer('data06_dly')->unsigned()->nullable();
            $table->float('data06_cal')->nullable();
            $table->string('data06_typ')->nullable();
            $table->boolean('data07_mon')->nullable();
            $table->float('data07_min')->nullable();
            $table->float('data07_max')->nullable();
            $table->integer('data07_dly')->unsigned()->nullable();
            $table->float('data07_cal')->nullable();
            $table->string('data07_typ')->nullable();
            $table->boolean('data08_mon')->nullable();
            $table->float('data08_min')->nullable();
            $table->float('data08_max')->nullable();
            $table->integer('data08_dly')->unsigned()->nullable();
            $table->float('data08_cal')->nullable();
            $table->string('data08_typ')->nullable();
            $table->boolean('data09_mon')->nullable();
            $table->float('data09_min')->nullable();
            $table->float('data09_max')->nullable();
            $table->integer('data09_dly')->unsigned()->nullable();
            $table->float('data09_cal')->nullable();
            $table->string('data09_typ')->nullable();
            $table->boolean('data10_mon')->nullable();
            $table->float('data10_min')->nullable();
            $table->float('data10_max')->nullable();
            $table->integer('data10_dly')->unsigned()->nullable();
            $table->float('data10_cal')->nullable();
            $table->string('data10_typ')->nullable();
            $table->boolean('data11_mon')->nullable();
            $table->float('data11_min')->nullable();
            $table->float('data11_max')->nullable();
            $table->integer('data11_dly')->unsigned()->nullable();
            $table->float('data11_cal')->nullable();
            $table->string('data11_typ')->nullable();

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
