<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOppgaverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oppgaver', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fil')->nullable();
            $table->integer('bedrift_id')->nullable();
            $table->string('type')->nullable();
            $table->string('tittel')->nullable();
            $table->string('info')->nullable();
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
        Schema::drop('oppgaver');
    }
}
