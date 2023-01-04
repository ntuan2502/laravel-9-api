<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faculty::create([
            'name' => 'Công nghệ thông tin',
            'slug' => Str::slug('Công nghệ thông tin', '-')
        ]);
        Faculty::create([
            'name' => 'Toán - Tin',
            'slug' => Str::slug('Toán - Tin', '-')
        ]);
        Faculty::create([
            'name' => 'Công nghệ sinh học',
            'slug' => Str::slug('Công nghệ sinh học', '-')
        ]);
        Faculty::create([
            'name' => 'Hóa học',
            'slug' => Str::slug('Hóa học', '-')
        ]);
        Faculty::create([
            'name' => 'Môi trường',
            'slug' => Str::slug('Môi trường', '-')
        ]);
    }
}
