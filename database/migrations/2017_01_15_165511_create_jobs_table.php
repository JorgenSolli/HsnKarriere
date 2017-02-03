<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->primary('id');
            $table->integer('bedrift_id')->references('id')->on('users');
            $table->string('sted');
            $table->integer('varighet_int');
            $table->string('varighet_prefix');
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
        Schema::drop('jobs');
    }
}
