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
            $table->increments('id');
            $table->string('type_samarbeid');
            $table->integer('bedrift_id');
            $table->integer('student_id');
            $table->integer('foreleser_id');
            $table->integer('godkjent_av_foreleser');
            $table->integer('godkjent_av_student');
            $table->integer('godkjent_av_bedrift');
            $table->integer('signert_av_student');
            $table->integer('signert_av_bedrift');
            $table->integer('kontrakt_godkjent_av_foreleser');
            $table->string('kontrakt');
            $table->string('arbeidsbesk');
            $table->date('startdato');
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
