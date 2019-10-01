<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->integer('dni')->nullable();
            $table->integer('phone_area_code')->nullable();
            $table->integer('phone_number')->nullable();
            $table->string('address')->nullable();

            $table->string('notification_email_1')->nullable();
            $table->string('notification_email_2')->nullable();
            $table->string('notification_email_3')->nullable();
            $table->string('notification_phone_number_1')->nullable();
            $table->string('notification_phone_number_2')->nullable();
            $table->string('notification_phone_number_3')->nullable();
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
        Schema::dropIfExists('users');
    }
}
