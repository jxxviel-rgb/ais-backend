<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateActivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->uuid('id')->primary()->index()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('vessel_id')->index();
            $table->uuid('company_id')->index();
            $table->date('sail_date');
            $table->date('berth_date')->nullable();
            $table->uuid('pelabuhan_sail_id');
            $table->uuid('pelabuhan_berth_id')->nullable();
            $table->boolean('is_sail');
            $table->integer('amount')->nullable();
            $table->timestamps();

            $table->foreign('vessel_id')->references('id')->on('vessel');
            $table->foreign('company_id')->references('id')->on('company');
            $table->foreign('pelabuhan_sail_id')->references('id')->on('pelabuhan');
            $table->foreign('pelabuhan_berth_id')->references('id')->on('pelabuhan');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity');
    }
}
