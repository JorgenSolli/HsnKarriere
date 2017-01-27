<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partnerships', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_samarbeid');
            $table->integer('bedrift_id');
            $table->integer('student_id');
            $table->integer('foreleser_id');
            $table->boolean('godkjent_av_foreleser');
            $table->boolean('godkjent_av_student');
            $table->boolean('godkjent_av_bedrift');
            $table->boolean('signert_av_student');
            $table->boolean('signert_av_bedrift');
            $table->boolean('kontrakt_godkjent_av_foreleser');
            $table->string('kontrakt');
            $table->text('arbeidsbesk');
            $table->string('startdato');

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
        Schema::dropIfExists('partnerships');
    }
}
