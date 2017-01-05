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
            $table->integer('bedrift_id')->nullable();
            $table->string('sted')->nullable();
            $table->string('varighet')->nullable();
            $table->string('type')->nullable();
            $table->string('frist')->nullable();
            $table->string('stilling_tittel')->nullable();
            $table->string('bransje')->nullable();
            $table->text('info')->nullable();
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
