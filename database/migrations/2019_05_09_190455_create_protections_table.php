<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('icon_id')->nullable();
            $table->string('type');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('protections');
    }
}
