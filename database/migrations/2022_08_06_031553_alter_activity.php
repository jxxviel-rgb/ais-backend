<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterActivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity', function(Blueprint $table) {
            $table->uuid('jenis_tangkapan_id')->index()->nullable();
            $table->foreign('jenis_tangkapan_id')->references('id')->on('jenis_tangkapan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity', function(Blueprint $table) {
            $table->dropForeign(['jenis_tangkapan_id']);
            $table->dropColumn('jenis_tangkapan_id');
        });
    }
}
