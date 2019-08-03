<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebhooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webhooks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('webhook_identifier')->nullable();
            $table->string('type')->nullable();
            $table->integer('user_id')->nullable();
            $table->unsignedBigInteger('application_id')->unique();
            $table->integer('version')->nullable();
            $table->string('action')->nullable();
            $table->integer('data_id')->nullable();
            $table->string('date_created')->nullable();
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
        Schema::dropIfExists('webhooks');
    }
}
