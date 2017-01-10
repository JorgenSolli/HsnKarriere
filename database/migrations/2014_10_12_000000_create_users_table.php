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
            $table->string('password')->nullable();
            $table->string('bruker_type')->nullable();
            $table->integer('bruker_aktivert')->nullable();
            $table->string('token')->nullable();
            $table->string('fornavn')->nullable();
            $table->string('etternavn')->nullable();
            $table->integer('telefon')->nullable();
            $table->string('adresse')->nullable();
            $table->string('postnr')->nullable();
            $table->string('poststed')->nullable();
            $table->text('bio')->nullable();
            $table->string('dob')->nullable();
            $table->string('profilbilde')->nullable();
            $table->string('forsidebilde')->nullable();
            $table->integer('student_nr')->nullable();
            $table->string('student_campus')->nullable();
            $table->string('student_cv')->nullable();
            $table->string('student_attester')->nullable();
            $table->string('student_studerer')->nullable();
            $table->string('bedrift_navn')->nullable();
            $table->string('bedrift_avdeling')->nullable();
            $table->string('bedrift_fagfelt')->nullable();
            $table->string('foreleser_rom_nr')->nullable();
            $table->string('nettside')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->date('sist_aktiv')->nullable();
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
