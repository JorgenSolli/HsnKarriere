<?php

use Illuminate\Database\Seeder;

class StudentStudyTableSeeder extends Seeder {

    public function run() {
        factory('App\StudentStudy', 1000)->create();
    }
}