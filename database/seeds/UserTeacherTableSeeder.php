<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTeacherTableSeeder extends Seeder {

    public function run() {
    	$faker = Faker::create();
    	
        factory('App\User', 200)->create([
        	'bruker_type' => 'faglarer',
        	'foreleser_rom_nr' => $faker->numberBetween($min = 1000, $max = 9999),
        	'profilbilde' => 'img/profilbilder/faglarer_profilbilde.png',
    		'forsidebilde' => 'img/forsidebilder/bedrift_forsidebilde.jpg'
		]);
    }
}
