<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            Doctor::create([
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'gender' => 0,
                'dob' => fake()->date(),
                'department_id' => 1,
                'signature' => fake()->name(),
            ]);
        }
    }
}
