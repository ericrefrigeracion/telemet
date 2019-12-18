<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPerformanceTinyTTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tiny_t_devices', function (Blueprint $table) {
            $table->boolean('on_performance')->nullable()->after('on_t_set_point');
            $table->integer('pdly')->unsigned()->nullable()->after('tmax');
            $table->float('pmin')->unsigned()->nullable()->after('pdly');
            $table->float('pmax')->unsigned()->nullable()->after('pmin');
            $table->dateTime('p_out_at')->nullable()->after('t_out_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tiny_t_devices', function (Blueprint $table) {
            $table->dropColumn('on_performance');
            $table->dropColumn('pdly');
            $table->dropColumn('pmin');
            $table->dropColumn('pmax');
            $table->dropColumn('p_out_at');
        });
    }
}
