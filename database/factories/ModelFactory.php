<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
	$maxStudents  = 1000;
	$maxCompanies = 500;
	$maxTeachers  = 200;
	
    return [
        'email' => $faker->numberBetween($min = 000000, $max = 179999) . $faker->email,
        'password' => bcrypt('Asd123'),
        'bruker_type' => '',
        'token' => '',
        'fornavn' => $faker->firstName,
        'etternavn' => $faker->lastName,
        'telefon' => $faker->numberBetween($min = 00000000, $max = 99999999),
        'adresse' => $faker->streetAddress,
        'postnr' => $faker->numberBetween($min = 1000, $max = 9999),
        'poststed' => $faker->city,
        'bio' => $faker->text($maxNbChars = 500) ,
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'profilbilde' => '',
        'forsidebilde' => '',
        'student_nr' => $faker->numberBetween($min = 000000, $max = 179999),
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
        'bedrift_navn' => '',
        'bedrift_avdeling' => '',
        'foreleser_rom_nr' => '',
        'foreleser_avdeling' => '',
        'nettside' => $faker->url,
        'facebook' => $faker->url,
        'linkedin' => $faker->url,
        'sist_aktiv' => $faker->dateTime(),
        'remember_token' => str_random(10)
    ];
});

$factory->define(App\StudentStudy::class, function (Faker\Generator $faker) {
	$maxStudents  = 1000;
	$maxCompanies = 500;
	$maxTeachers  = 200;
	
    return [
        'user_id' => $faker->unique()->numberBetween($min = 1, $max = $maxStudents),
        'studie_id' => $faker->numberBetween($min = 1, $max = 385),
		'Campus' => $faker->randomElement($array = array (
			'Bø',
			'Porsgrunn',
			'Notodden',
			'Rauland',
			'Ringerike',
			'Drammen',
			'Kongsberg',
			'Vestfold'
		)),
		'fra' => $faker->numberBetween($min = 1995, $max = 2017),
		'til' => $faker->numberBetween($min = 2012, $max = 2020)
    ];
});

$factory->define(App\Company::class, function (Faker\Generator $faker) {
	$maxStudents  = 1000;
	$maxCompanies = 500;
	$maxTeachers  = 200;
	
    return [
        'user_id' => $faker->unique()->numberBetween($min = $maxStudents + 1, $max = $maxStudents + $maxCompanies),
		'studie_id' => $faker->numberBetween($min = 1, $max = 385)
    ];
});

$factory->define(App\Professor::class, function (Faker\Generator $faker) {
	$maxStudents  = 1000;
	$maxCompanies = 500;
	$maxTeachers  = 200;
	
    return [
        'user_id' => $faker->unique()->numberBetween($min = $maxStudents + $maxCompanies + 1, $max = $maxStudents + $maxCompanies + $maxTeachers),
        'studie_id' => $faker->numberBetween($min = 1, $max = 385)
    ];
});