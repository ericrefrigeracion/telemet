<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('device_id');
            $table->unsignedBigInteger('user_id');
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->string('description')->nullable();
            $table->string('method');
            $table->string('payer');
            $table->integer('amount');
            $table->timestamp('vigent_until')->nullable();
            $table->timestamps();

            $table->foreign('device_id')->references('id')->on('devices');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pays');
    }
}
