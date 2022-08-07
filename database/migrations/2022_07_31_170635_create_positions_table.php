<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position', function (Blueprint $table) {
            $table->uuid('id')->primary()->index()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('vessel_id')->index();
            $table->string('speed')->nullable();
            $table->string('course')->nullable();
            $table->float('latitude', 8, 4)->nullable();
            $table->float('longitude', 8, 4)->nullable();
            $table->string('navigation_status')->nullable();
            $table->timestamps();

            $table->foreign('vessel_id')->references('id')->on('vessel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('position');
    }
}
