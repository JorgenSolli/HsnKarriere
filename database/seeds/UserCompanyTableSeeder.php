<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserCompanyTableSeeder extends Seeder {
    public function run() {
    	$faker = Faker::create();
        
        factory('App\User', 500)->create([
        		'bruker_type' => 'bedrift',
        		'bedrift_navn' => $faker->unique()->company,
        		'profilbilde' => 'img/profilbilder/bedrift_profilbilde.png',
        		'forsidebilde' => 'img/forsidebilder/bedrift_forsidebilde.jpg',
        		'student_campus' => ""
		]);
    }
}
