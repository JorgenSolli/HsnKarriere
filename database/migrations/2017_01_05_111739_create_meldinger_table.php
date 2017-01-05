<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeldingerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meldinger', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fra_bruker_id')->nullable();
            $table->integer('til_bruker_id')->nullable();
            $table->string('tittel')->nullable();
            $table->string('innhold')->nullable();
            $table->string('sett_av')->nullable();
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
        Schema::drop('meldinger');
    }
}
