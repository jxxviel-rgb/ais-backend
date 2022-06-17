<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCrewDeparture extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crew_departure', function (Blueprint $table) {
            $table->uuid('id')->primary()->index()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('crew_id')->index();
            $table->uuid('activity_id')->index();
            $table->uuid('vessel_id')->index();
            $table->uuid('company_id')->index();
            $table->timestamps();

            $table->foreign('crew_id')->references('id')->on('crew');
            $table->foreign('activity_id')->references('id')->on('activity');
            $table->foreign('vessel_id')->references('id')->on('vessel');
            $table->foreign('company_id')->references('id')->on('company');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crew_departure');
    }
}
