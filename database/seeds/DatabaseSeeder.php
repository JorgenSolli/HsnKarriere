<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	protected $toTruncate = [
		'users', 
		'companies',
		'professors',
		'student_studies'
	];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach ($this->toTruncate as $table) {
    		DB::table($table)->truncate();
    	}

        $this->call(UserStudentTableSeeder::class);
        $this->call(StudentStudyTableSeeder::class);

        $this->call(UserCompanyTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        
        $this->call(UserTeacherTableSeeder::class);
        $this->call(ProfessorTableSeeder::class);
    }
}

/*
(SELECT * FROM `users` as student WHERE `bruker_type` = 'student' LIMIT 1)
UNION
(SELECT * FROM `users` as bedrift WHERE `bruker_type` = 'bedrift' LIMIT 1)
UNION
(SELECT * FROM `users` as faglarer WHERE `bruker_type` = 'faglarer' LIMIT 1)
*/