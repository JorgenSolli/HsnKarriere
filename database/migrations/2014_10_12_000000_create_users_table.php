<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('bruker_type');
            $table->integer('bruker_aktivert');
            $table->string('fornavn');
            $table->string('etternavn');
            $table->integer('telefon');
            $table->string('adresse');
            $table->string('postnr');
            $table->string('poststed');
            $table->text('bio');
            $table->date('dob');
            $table->string('profilbilde');
            $table->integer('student_nr');
            $table->string('student_campus');
            $table->string('student_cv');
            $table->string('student_attester');
            $table->string('student_studerer');
            $table->string('bedrift_navn');
            $table->string('bedrift_avdeling');
            $table->string('bedrift_fagfelt');
            $table->string('foreleser_rom_nr');
            $table->string('nettside');
            $table->string('facebook');
            $table->string('linkedin');
            $table->date('sist_aktiv');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
