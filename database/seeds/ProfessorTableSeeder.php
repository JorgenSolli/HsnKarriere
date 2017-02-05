<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProfessorTableSeeder extends Seeder {
    public function run() {
        factory('App\Professor', 200)->create();
    }
}