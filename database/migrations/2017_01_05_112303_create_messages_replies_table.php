<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages_replies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('melding_id')->nullable();
            $table->string('forfatter')->nullable();
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
        Schema::drop('messages_replies');
    }
}
