<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBekreftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bekreft', function (Blueprint $table) {
            $table->string('hash')->nullable();
            $table->string('email')->nullable();
            $table->integer('bruker_id')->nullable();
            $table->string('bruker_type')->nullable();
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
        Schema::drop('bekreft');
    }
}
