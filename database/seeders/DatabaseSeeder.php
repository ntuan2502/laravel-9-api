<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:seed --class=DatabaseSeeder
        $this->call([
            CreateAdminUserSeeder::class,
            FacultySeeder::class,
            DepartmentSeeder::class,
            DoctorSeeder::class,
        ]);
    }
}
