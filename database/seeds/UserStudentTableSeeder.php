<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserStudentTableSeeder extends Seeder {
	
    public function run() {
    	$faker = Faker::create();
        
        factory('App\User', 1000)->create([
			'bruker_type' => 'student',
			'profilbilde' => 'img/profilbilder/student_profilbilde.png',
			'forsidebilde' => 'img/forsidebilder/student_forsidebilde.jpg',
			'student_campus' => $faker->randomElement($array = array (
				'Bø',
				'Porsgrunn',
				'Notodden',
				'Rauland',
				'Ringerike',
				'Drammen',
				'Kongsberg',
				'Vestfold'
			)),

		]);
    }
}