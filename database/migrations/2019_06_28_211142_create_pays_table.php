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
            $table->unsignedBigInteger('collection_id');
            $table->unsignedBigInteger('merchant_order_id');
            $table->string('preference_id');
            $table->string('collection_status');
            $table->string('external_reference');
            $table->string('payment_type');
            $table->string('processing_mode');
            $table->string('verified_by_sistem')->nullable();
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
        Schema::dropIfExists('pays');
    }
}
