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
            $table->date('departure_date');
            $table->date('return_date')->nullable();
            $table->string('income');
            $table->timestamps();

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
        Schema::dropIfExists('activity');
    }
}
