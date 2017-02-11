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
            $table->string('provider')->nullable();
            $table->string('provider_id')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('token')->nullable();
            $table->string('password')->nullable();
            $table->string('bruker_type');
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
            $table->string('bedrift_navn')->nullable();
            $table->string('bedrift_avdeling')->nullable();
            $table->string('foreleser_rom_nr')->nullable();
            $table->string('foreleser_avdeling')->nullable();
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
