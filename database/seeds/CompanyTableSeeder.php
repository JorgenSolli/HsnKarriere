<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder {
    public function run() {
        factory('App\Company', 500)->create();
    }
}