<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name' => 'Công nghệ thông tin',
            'slug' => Str::slug('Công nghệ thông tin', '-'),
            'faculty_id' => 1,
        ]);
        Department::create([
            'name' => 'Công nghệ phần mềm',
            'slug' => Str::slug('Công nghệ phần mềm', '-'),
            'faculty_id' => 1,
        ]);
        Department::create([
            'name' => 'Khoa học máy tính',
            'slug' => Str::slug('Khoa học máy tính', '-'),
            'faculty_id' => 1,
        ]);
        Department::create([
            'name' => 'Hệ thống thông tin',
            'slug' => Str::slug('Hệ thống thông tin', '-'),
            'faculty_id' => 1,
        ]);
    }
}
