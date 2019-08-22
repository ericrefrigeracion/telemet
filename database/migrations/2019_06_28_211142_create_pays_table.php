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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('device_id');
            $table->float('item_amount');
            $table->string('preference_id');
            $table->string('operation_type');
            $table->dateTime('valid_at');
            $table->string('collection_status');
            $table->string('init_point');
            $table->string('status_detail')->nullable();
            $table->dateTime('verified_by_sistem')->nullable();
            $table->string('external_reference')->nullable();
            $table->unsignedBigInteger('collection_id')->nullable();
            $table->unsignedBigInteger('merchant_order_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('site_id')->nullable();
            $table->string('processing_mode')->nullable();
            $table->string('merchant_account_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
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
