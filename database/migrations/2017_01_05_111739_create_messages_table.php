<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->primary('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('user_name');
            $table->string('subject');
            $table->string('message');
            $table->timestamps();
        });

        Schema::create('messages_junctions', function(Blueprint $table) {
            $table->primary('id');
            $table->integer('message_id')->references('id')->on('messages');
            $table->integer('user_id')->references('id')->on('users');
            $table->string('user_name');
            $table->text('message');
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
        Schema::drop('messages');
        Schema::drop('messages_junctions');
    }
}
