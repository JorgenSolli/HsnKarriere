<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSamarbeidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samarbeid', function (Blueprint $table) {
            $table->primary('id');
            $table->string('type_samarbeid');
            $table->integer('bedrift_id')->references('id')->on('users');
            $table->integer('student_id')->references('id')->on('users');
            $table->integer('foreleser_id')->references('id')->on('users');
            $table->integer('godkjent_av_foreleser')->nullable();
            $table->integer('godkjent_av_student')->nullable();
            $table->integer('godkjent_av_bedrift')->nullable();
            $table->integer('signert_av_student')->nullable();
            $table->integer('signert_av_bedrift')->nullable();
            $table->integer('kontrakt_godkjent_av_foreleser')->nullable();
            $table->string('kontrakt')->nullable();
            $table->string('arbeidsbesk')->nullable();
            $table->string('startdato')->nullable();
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
        Schema::drop('samarbeid');
    }
}
