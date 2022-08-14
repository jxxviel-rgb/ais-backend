<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateVessel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vessel', function (Blueprint $table) {
            $table->uuid('id')->primary()->index()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('company_id')->index();
            $table->integer('msg_type');
            $table->string('mmsi');
            $table->string('name');
            $table->string('imo');
            $table->string('no_ais');
            $table->string('image');
            $table->string('call_sign');
            $table->string('type');
            $table->integer('length');
            $table->integer('width');
            $table->integer('gt');
            $table->integer('netto');
            $table->string('years');
            $table->timestamps();

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
        Schema::dropIfExists('vessel');
    }
}
