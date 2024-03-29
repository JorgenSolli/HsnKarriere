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
            $table->integer('message_id');
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('user_name');
            $table->text('message');
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
