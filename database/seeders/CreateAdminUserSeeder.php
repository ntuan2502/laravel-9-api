<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:seed --class=CreateAdminUserSeeder

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'ntuan.2502@gmail.com',
            'password' => Hash::make('123123'),
        ]);
    }
}
