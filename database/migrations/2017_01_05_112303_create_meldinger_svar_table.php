<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeldingerSvarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meldinger_svar', function (Blueprint $table) {
            $table->increments('svar_id');
            $table->integer('melding_id');
            $table->string('forfatter');
            $table->string('innhold');
            $table->string('sett_av');
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
        Schema::drop('meldinger_svar');
    }
}
