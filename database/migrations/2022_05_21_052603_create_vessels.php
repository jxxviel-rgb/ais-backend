<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('vessels', function (Blueprint $table) {
            $table->uuid('id')->primary()->index()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('vessels_type_id')->index();
            $table->uuid('fisherman_id')->index();
            $table->string('name')->index();
            $table->string('call_signin');
            $table->string('imo');
            $table->integer('length');
            $table->integer('width');
            $table->integer('depth');
            $table->integer('gt');
            $table->integer('netto');
            $table->integer('year');
            $table->string('description')->nullable();
            $table->string('picture')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('vessels_type_id')->references('id')->on('vessels_types');
            $table->foreign('fisherman_id')->references('id')->on('fishermans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vessels');
    }
};
