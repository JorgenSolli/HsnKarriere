<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStillingerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stillinger', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bedrift_id');
            $table->string('sted');
            $table->string('varighet');
            $table->string('type');
            $table->string('frist');
            $table->string('stilling_tittel');
            $table->string('bransje');
            $table->text('info');
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
        Schema::drop('stillinger');
    }
}
