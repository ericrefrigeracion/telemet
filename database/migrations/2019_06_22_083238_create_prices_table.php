<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_device_id');
            $table->float('price');
            $table->string('description');
            $table->string('excluded')->nullable();
            $table->integer('days')->nullable();
            $table->integer('installments')->nullable();
            $table->timestamps();

            $table->foreign('type_device_id')->references('id')->on('type_devices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices');
    }
}