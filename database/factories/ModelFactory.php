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
        'student_campus' => '',
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
        'studie' => $faker->randomElement($array = array (	
			'Geografiske Informasjonssystemer',
			'Regnskap og Revisjon',
			'Eiendomsmegling',
			'Informasjonssystemer',
			'Informatikk',
			'Innovasjon og Entreprenørskap',
			'Internasjonal Markedsføring',
			'Turisme og Ledelse',
			'Økonomi og Administrasjon',
			'Trenerutdannelse i Idrett',
			'Fysisk Aktivitet og Helse',
			'Idrettsadministrasjon og Ledelse',
			'Friluftsliv, Kultur- og Naturveileder',
			'Master i Kroppsøving, Idrett- og Friluftsliv',
			'Språk og Litteratur',
			'Engelsk',
			'Kulturledelse',
			'Historiske Fag',
			'Kulturstudier',
			'Økologi og Naturforvaltning',
			'Forurensing og Miljø',
			'Natur-, Helse- og Miljøvern',
			'Akvatisk Økologi',
			'Environmental Science',
			'Alpine Ecology',
			'Sykepleie',
			'Barnevern i et Flerkulturelt Samfunn</option>',
			'Vernepleie',
			'Elkraftteknikk',
			'Informatikk og Automatisering',
			'Industrial IT and Automation',
			'Electrical Power Engineering',
			'Byggdesign',
			'Maskinteknisk Design',
			'Plan og Infrastruktur',
			'Gass- og Energiteknologi',
			'Energy and Environmental Technology',
			'Process Technology',
			'Grunnskolelærer, 5. - 10. trinn',
			'Grunnskolelærer, 1. - 7. trinn',
			'Barnehagelærer'
		)),
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
		'area_of_expertise' => $faker->randomElement($array = array (	
			'Geografiske Informasjonssystemer',
			'Regnskap og Revisjon',
			'Eiendomsmegling',
			'Informasjonssystemer',
			'Informatikk',
			'Innovasjon og Entreprenørskap',
			'Internasjonal Markedsføring',
			'Turisme og Ledelse',
			'Økonomi og Administrasjon',
			'Trenerutdannelse i Idrett',
			'Fysisk Aktivitet og Helse',
			'Idrettsadministrasjon og Ledelse',
			'Friluftsliv, Kultur- og Naturveileder',
			'Master i Kroppsøving, Idrett- og Friluftsliv',
			'Språk og Litteratur',
			'Engelsk',
			'Kulturledelse',
			'Historiske Fag',
			'Kulturstudier',
			'Økologi og Naturforvaltning',
			'Forurensing og Miljø',
			'Natur-, Helse- og Miljøvern',
			'Akvatisk Økologi',
			'Environmental Science',
			'Alpine Ecology',
			'Sykepleie',
			'Barnevern i et Flerkulturelt Samfunn</option>',
			'Vernepleie',
			'Elkraftteknikk',
			'Informatikk og Automatisering',
			'Industrial IT and Automation',
			'Electrical Power Engineering',
			'Byggdesign',
			'Maskinteknisk Design',
			'Plan og Infrastruktur',
			'Gass- og Energiteknologi',
			'Energy and Environmental Technology',
			'Process Technology',
			'Grunnskolelærer, 5. - 10. trinn',
			'Grunnskolelærer, 1. - 7. trinn',
			'Barnehagelærer'
		))
    ];
});

$factory->define(App\Professor::class, function (Faker\Generator $faker) {
	$maxStudents  = 1000;
	$maxCompanies = 500;
	$maxTeachers  = 200;
	
    return [
        'user_id' => $faker->unique()->numberBetween($min = $maxStudents + $maxCompanies + 1, $max = $maxStudents + $maxCompanies + $maxTeachers),
        'studie' => $faker->randomElement($array = array (	
			'Geografiske Informasjonssystemer',
			'Regnskap og Revisjon',
			'Eiendomsmegling',
			'Informasjonssystemer',
			'Informatikk',
			'Innovasjon og Entreprenørskap',
			'Internasjonal Markedsføring',
			'Turisme og Ledelse',
			'Økonomi og Administrasjon',
			'Trenerutdannelse i Idrett',
			'Fysisk Aktivitet og Helse',
			'Idrettsadministrasjon og Ledelse',
			'Friluftsliv, Kultur- og Naturveileder',
			'Master i Kroppsøving, Idrett- og Friluftsliv',
			'Språk og Litteratur',
			'Engelsk',
			'Kulturledelse',
			'Historiske Fag',
			'Kulturstudier',
			'Økologi og Naturforvaltning',
			'Forurensing og Miljø',
			'Natur-, Helse- og Miljøvern',
			'Akvatisk Økologi',
			'Environmental Science',
			'Alpine Ecology',
			'Sykepleie',
			'Barnevern i et Flerkulturelt Samfunn</option>',
			'Vernepleie',
			'Elkraftteknikk',
			'Informatikk og Automatisering',
			'Industrial IT and Automation',
			'Electrical Power Engineering',
			'Byggdesign',
			'Maskinteknisk Design',
			'Plan og Infrastruktur',
			'Gass- og Energiteknologi',
			'Energy and Environmental Technology',
			'Process Technology',
			'Grunnskolelærer, 5. - 10. trinn',
			'Grunnskolelærer, 1. - 7. trinn',
			'Barnehagelærer'
		))
    ];
});