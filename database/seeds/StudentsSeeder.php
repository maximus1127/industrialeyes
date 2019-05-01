<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();

    for($i = 0; $i < 100; $i++) {
        App\Student::create([
            'fname' => $faker->firstName,
            'lname' => $faker->lastName,
            'gender' => $faker->randomElement(['male', 'female']),
            'student_number' => $faker->randomNumber,
            'dob' => $faker->date,
        ]);
    }

    }
}
